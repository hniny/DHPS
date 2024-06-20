<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerOrder extends Mailable
{
    private $customerOrder;
    private $customerName;
    private $orderItems;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName, $customerOrder, $orderItems)
	{
		$this->customerName = $customerName;
		$this->customerOrder = $customerOrder;
		$this->orderItems = $orderItems;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $FROM_MAIL = env('MAIL_FROM_ADDRESS', 'dev44.hmm@gmail.com');
        // dd($FROM_MAIL);
        return $this->from($FROM_MAIL)->markdown('emails.customerorder')
        ->with('customerName',$this->customerName)
        ->with('customerOrder',$this->customerOrder)
        ->with('orderItems',$this->orderItems);
    }
}
