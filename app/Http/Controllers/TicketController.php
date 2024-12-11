<?php
namespace App\Http\Controllers;

use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Venta; // Asegúrate de tener el modelo de Venta

class VentaController extends Controller
{
    public function enviarTicket(Request $request)
    {
        // Valida el correo
        $request->validate([
            'email' => 'required|email',
        ]);

        // Aquí deberías generar el PDF y obtener la ruta
        // Por ejemplo, usando tu lógica para generar el PDF
        $pdfPath = 'tickets/ticket.pdf'; // Aquí deberías colocar la ruta real donde guardaste el PDF

        // Enviar el correo con el PDF adjunto
        Mail::to($request->email)->send(new TicketMail($pdfPath, $request->email));

        return response()->json(['message' => 'Ticket enviado con éxito.']);
    }
}
