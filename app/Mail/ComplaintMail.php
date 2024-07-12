<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;
    public $user;
    public $categoryName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($complaint, $user, $categoryName)
    {
        $this->complaint = $complaint;
        $this->user = $user;
        $this->categoryName = $categoryName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Pengaduan Baru')
            ->view('Emails.ComplaintMail')
            ->with([
                'user_name' => $this->user->name,
                'user_agency' => $this->user->agency,
                'no_complaint' => $this->complaint->no_complaint,
                'created_at' => $this->complaint->created_at,
                'category' => $this->categoryName,
                'description_complaint' => $this->complaint->description_complaint,
            ]);
    }
}
