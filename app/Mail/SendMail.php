<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Plan;
use App\Models\Term;
use App\Models\Privacy;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public $details;
    public function __construct($details)
    {
       $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        // $plans = Plan::all();
        // $privacies = Privacy::get();
        // $terms = Term::get();
        // $htmlContent = view('welcome', compact('plans', 'privacies', 'terms'))->render();
        //  return $this->subject('Mail from ItSolutionStuff.com')
        //             ->view('emails.myTestMail');
           return new Content('email.email');
           // return new Content('welcome',$htmlContent);
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
