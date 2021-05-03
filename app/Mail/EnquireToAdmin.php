<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquireToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
 
  public function __construct( $data)
    {

        $this->data = $data;

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.to_admin_enquire_email')
                    ->subject('Enquire By '.'('. $this->data['email'].') ')
                    ->with([
                        'name' => $this->data['name'],
                        'email' => $this->data['email'],
                        'id' => $this->data['id'],
                        'mobile' => $this->data['mobile'],
                        'enquire' => $this->data['enquire'],
                    ]);
    }
}
