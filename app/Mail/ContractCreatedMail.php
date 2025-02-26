<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract; 
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->contract = $data['contract']; 
    }
    
    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('تم أضافة عقد جديد في حسابك')
                    ->view('emails.contract_created');
    }
}
