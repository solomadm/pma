<?php

namespace App\Mail;

use App\Media;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MediaRegisterNotification extends Mailable
{

    use Queueable, SerializesModels;

    protected $media;


    /**
     * ContactNotification constructor.
     *
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.media-registered')->with(
            [
                'media' => $this->media,
            ]
        );
    }
}
