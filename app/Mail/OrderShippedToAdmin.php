<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShippedToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $order;


    /**
     * Create a new message instance.
     *
     * @return void
     */
 
  public function __construct( $order)
    {

        $this->order = $order;

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.admin_order_email')
                    ->subject('Order #'.$this->order['order_id'])
                    ->with([
                        'orders' => $this->order['orders'],
                        'order_id' => $this->order['order_id'],
                        'email' => $this->order['email'],
                        'total_price' => $this->order['total_price'],
                        'address' => $this->order['address'],
                    ]);
    }
}
