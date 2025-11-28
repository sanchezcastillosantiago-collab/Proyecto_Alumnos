<?php

namespace App\Http\Controllers;

use App\Mail\CustomEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function create()
    {
        return view('emails.send-custom');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        try {
            Mail::to($data['to'])->send(new CustomEmail($data['subject'], $data['body']));
        } catch (\Exception $e) {
            // Log the exception so the developer can inspect it in storage/logs/laravel.log
            Log::error('Error enviando correo personalizado', [
                'to' => $data['to'],
                'subject' => $data['subject'],
                'exception' => $e->getMessage(),
            ]);

            // Return a friendly message to the user and suggest checking logs or SMTP config
            return back()->with('error', 'No se pudo enviar el correo. Revisa la configuración de mail (MAIL_MAILER en .env) y storage/logs/laravel.log para más detalles.');
        }

        return back()->with('success', 'Correo enviado correctamente.');
    }
}
