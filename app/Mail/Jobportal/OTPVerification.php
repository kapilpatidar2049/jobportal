<?php

namespace App\Mail\Jobportal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Store the OTP

    /**
     * Create a new message instance.
     *
     * @param string $otp
     */
    public function __construct(string $otp)
    {
        $this->otp = $otp; // Assign the OTP to the public property
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OTP Verification From JobPortal',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.jobportal.otp_verification', // Update this path to your actual view
            with: [
                'otp' => $this->otp, // Pass the OTP to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
