<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Newuser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data =$data;
    }

    public function build()
    {
        // return $this->view('view.name');
        return $this->subject($this->data->title)->view('friendRequest')->with('data', $this->data);
    }
}
