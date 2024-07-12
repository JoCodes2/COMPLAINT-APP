<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintReviewedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function build()
    {
        return $this->view('Emails.complaintReviewed')
            ->with([
                'no_complaint' => $this->complaint->no_complaint,
                'tanggal_complaint' => $this->complaint->created_at,
                'category' => $this->complaint->categoryComplaint->name_category,
                'description' => $this->complaint->description_complaint,
            ]);
    }
}
