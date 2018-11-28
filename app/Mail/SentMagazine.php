<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentMagazine extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var string */
    public $email;
    /** @var string */
    public $name;
    /** @var string */
    private $title;
    /** @var string */
    public $description;
    /** @var string|null */
    public $footer;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $name
     * @param string $title
     * @param string $description
     * @param string|null $footer
     */
    public function __construct(string $email, string $name, string $title, string $description, ?string $footer)
    {
        $this->email = $email;
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->footer = $footer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->title)
            ->markdown('emails.magazine');
    }
}
