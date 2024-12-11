<?php
use Illuminate\Mail\Mailable;

class TicketMail extends Mailable
{
    public $venta;
    public $pdf;

    public function __construct($venta, $pdf)
    {
        $this->venta = $venta;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Ticket de Venta')
                    ->view('emails.ticket')
                    ->attachData($this->pdf, 'ticket.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
