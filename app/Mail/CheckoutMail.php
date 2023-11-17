<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public function __construct($mailData)
    {
        $this->mailData =$mailData;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Furniture.comp qapali sehmdar cemiyyeti',
        );
    }

    public function content()
    {
        return new Content(
            view: 'frontend.emails.checkout_mail',
        );
    }

    public function attachments()
    {
        for($i =0 ; $i<count($this->mailData['body']['item']);$i+=2){
            return [
                Attachment::fromPath(asset($this->mailData['body']['item'][$i]['path1']))
                    ->withMime('application/jpg')
                    ->withMime('application/jpeg')
                    ->withMime('application/png')
            ];
        }
        foreach ($this->mailData['body'] as $index => $product) {
            if (is_object($product)) {
                // This is a product object, you can access its properties like 'path1'
                $product_path = $product->path1;

            }
        }
        return [];
    }


}
