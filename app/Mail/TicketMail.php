<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    // Propiedad pública para almacenar los detalles de la venta
    public $detalleventas;

    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param $detalleventas
     */
    public function __construct($detalleventas)
    {
        $this->detalleventas = $detalleventas;
    }

    /**
     * Definir el asunto del correo.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ticket de Venta'
        );
    }

    /**
     * Definir la vista y datos que se enviarán.
     */
    public function content()
    {
        return new Content(
            view: 'emails.ticket',
            with: [
                'detalle_ventas' => $this->detalleventas,
            ]
        );
    }

    /**
     * Adjuntar archivos si es necesario.
     */
    public function attachments()
    {
        return [];
    }
}
