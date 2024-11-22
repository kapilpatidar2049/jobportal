<?php

namespace App\Http\Controllers;

use App\Models\marketplace\MarketplaceChat;
use App\Models\marketplace\MarketplaceMessage;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;

class MarketplaceMessageController extends Controller
{
    public function index(Request $request)
    {

        $users = MarketplaceChat::where('user_id', Auth::user()->id)->orWhere('client_id', Auth::user()->id)->get();

        $receiver_id = $request->input('receiver_id', session('receiver_id'));
        if (!$receiver_id) {
            return redirect()->route('chats.index')->with('error', 'Receiver not selected');
        }

        $chat = MarketplaceChat::where(function ($query) use ($receiver_id) {
            $query->where('user_id', Auth::user()->id)
                ->where('client_id', $receiver_id);
        })
            ->orWhere(function ($query) use ($receiver_id) {
                $query->where('user_id', $receiver_id)
                    ->where('client_id', Auth::user()->id);
            })
            ->first();


        if (!$chat && $receiver_id !== Auth::user()->id) {
            $chat = MarketplaceChat::create([
                'user_id' => Auth::user()->id,
                'client_id' => $receiver_id
            ]);
        }

        $messages = $chat->messages()->orderBy('created_at', 'asc')->get();
        $selectedUser = User::find($receiver_id);

        return view('marketplace.chat.index', compact('users', 'selectedUser', 'messages', 'chat'));
    }

    public function sendMessage(Request $request)
    {

        if (empty($request->message) && !$request->hasFile('attachment')) {
            return back()->with('error', 'Please send a message or a file.');
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $userId = Auth::user()->id;
        $receiverId = $request->receiver_id;
        $chat = MarketplaceChat::where(function ($query) use ($userId, $receiverId) {
            $query->where('user_id', $userId)
                ->where('client_id', $receiverId);
        })
            ->orWhere(function ($query) use ($userId, $receiverId) {
                $query->where('user_id', $receiverId)
                    ->where('client_id', $userId);
            })
            ->first();

            if (!$chat && $receiverId !== Auth::user()->id) {
                $chat = MarketplaceChat::create([
                    'user_id' => $userId,
                    'client_id' => $receiverId
                ]);
            }

        // Create the new message
        $message = new MarketplaceMessage();
        $message->chat_id = $chat->id;
        $message->sender_id = $userId;
        $message->receiver_id = $receiverId;
        $message->message = $request->message;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $filename);
            $message->attachment  = $filename;
        }

        $message->save();

        // Broadcast the message
        broadcast(new MessageSent($message))->toOthers();

        return redirect()->route('chats.index', ['receiver_id' => $receiverId]);
    }

    public function setReceiver(Request $request)
    {
        session(['receiver_id' => $request->receiver_id]);

        return response()->json(['status' => 'Receiver ID set successfully']);
    }

    public function fetchMessages(Request $request)
    {
        $receiverId = $request->receiver_id;
        $messages = MarketplaceMessage::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId)
                ->orWhere('receiver_id', Auth::id())
                ->where('sender_id', $receiverId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}
