<?php
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TicketMail extends Mailable
{
    public $detalleventas;

    public function __construct($detalleventas)
    {
        $this->detalleventas = $detalleventas;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Ticket de Venta'
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.ticket',
            with: ['detalleventas' => $this->detalleventas]
        );
    }

    public function attachments()
    {
        return [];
    }
}
