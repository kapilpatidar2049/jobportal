<?php

namespace App\Http\Controllers;

use App\Events\MessageSent; // You might use this for broadcasting messages later.
use App\Models\Jobportal\JobportalNotification;
use App\Models\JobPortalUser;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;

class ChatController extends Controller
{
    protected $avatar;

    public function __construct(Avatar $avatar)
    {
        $this->avatar = $avatar;
    }

    // --------------------------------UserList Code Start-------------------------------------
    public function userlist()
    {
        return view('jobportal.chat.userlist');
    }
    public function userlistuser()
    {
        return view('jobportal.front.chat.userlist');
    }
    // --------------------------------UserList Code End-------------------------------------

    // --------------------------------Update UserList Dynamically Code Start-------------------------------------
    public function index()
    {
        $userId = Auth::guard('jobportal')->user()->id;

        // Get sent and received messages
        $sentMessages = Message::where('sender_id', $userId)->select('receiver_id as user_id');
        $receivedMessages = Message::where('receiver_id', $userId)->select('sender_id as user_id');

        // Combine user IDs from both sent and received messages
        $userIds = $sentMessages->union($receivedMessages)->pluck('user_id');

        // Get user details with last message and seen status
        $users = JobPortalUser::whereIn('id', $userIds)
            ->get()
            ->map(function ($user) use ($userId) {
                $lastMessage = Message::where(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $userId)->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', $userId);
                })
                ->latest('id')
                ->first();

                // Set user properties
                $user->last_message = $lastMessage ? $this->getFirstFiveWords($lastMessage->message) : null;
                $user->seen = $lastMessage ? $lastMessage->seen : null;
                $user->seen_at = $lastMessage ? $lastMessage->seen_at : null; // Include seen_at
                $user->time = $lastMessage ? Carbon::parse($lastMessage->created_at)->diffForHumans() : null;
                $user->avatar = $this->avatar->create($user->email)->toBase64();
                $user->last_message_time = $lastMessage ? $lastMessage->created_at : null;
                $user->receiver_id = $lastMessage ? $lastMessage->receiver_id : null;
                $user->auth_id = Auth::guard('jobportal')->user()->id;

                return $user;
            })
            ->sortByDesc('last_message_time')
            ->values();

        return response()->json($users);
    }
    // --------------------------------Update UserList Dynamically Code End-------------------------------------

    // --------------------------------Chat Page Code Start-------------------------------------
    public function chat($userId)
    {
        $reciever = JobPortalUser::find($userId);
        if (!$reciever) {
            return abort(404);
        }
        $receiverId = $userId;
        $recieverEmail = $reciever->email;
        return view('jobportal.chat.chat',compact('receiverId','recieverEmail'));
    }

    public function userChat($userId)
    {
        $reciever = JobPortalUser::find($userId);
        if (!$reciever) {
            return abort(404);
        }
        $receiverId = $userId;
        $recieverEmail = $reciever->email;
        return view('jobportal.front.chat.chat',compact('receiverId','recieverEmail'));
    }
    // --------------------------------Chat Page Code End-------------------------------------

    // --------------------------------Send Message Code Start-------------------------------------
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:job_portal_users,id',
            'message' => 'required|string',
        ]);

        // Create the message
        $message = Message::create([
            'sender_id' => Auth::guard('jobportal')->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        JobportalNotification::create([
            'user_id' => $request->receiver_id,
            'message'=>'You have new message form '.Auth::guard('jobportal')->user()->name
        ]);

        return response()->json(['status' => 'Message sent!']);
    }
    // --------------------------------Send Message Code End-------------------------------------

    // --------------------------------Get Messages Code Start-------------------------------------
    public function getMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::guard('jobportal')->user()->id)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->where('receiver_id', Auth::guard('jobportal')->user()->id);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }
    // --------------------------------Get Messages Code End-------------------------------------

    // --------------------------------Mark Messages as Seen Code Start-------------------------------------
    public function markSeen(Request $request)
    {
        $validated = $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id', // Ensure each ID exists in the messages table
        ]);

        $userId = Auth::guard('jobportal')->user()->id;
        // return $userId;
        $msg_update_count = 0; // Counter for updated messages

        foreach ($request->message_ids as $message) {
            $msg_update = Message::where('receiver_id', $userId)->where('id', $message)->update([
                'seen_at' => now(), // Update seen_at timestamp
                'seen' => 1 // Mark as seen
            ]);
            $msg_update_count += $msg_update; // Count how many messages were updated
        }

        if ($msg_update_count > 0) {
            return response()->json(['status' => 'Messages marked as seen']);
        } else {
            return response()->json(['status' => 'No messages updated'], 404);
        }
    }
    // --------------------------------Mark Messages as Seen Code End-------------------------------------
    function getFirstFiveWords($string) {
        // Split the string into words
        $words = preg_split('/\s+/', trim($string));

        // Get the first five words
        $firstFiveWords = array_slice($words, 0, 5);

        // Join them back into a string
        return implode(' ', $firstFiveWords);
    }
}
