<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        // Obtener servicios para el dropdown del formulario
        $services = DB::table('services')->where('is_active', true)->get();
        
        return view('contact.index', compact('services'));
    }

    public function send(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'nullable|exists:services,id',
            'message' => 'required|string|max:2000'
        ]);
        
        // Obtener el nombre del servicio si se seleccionó uno
        $serviceName = null;
        if ($validated['service']) {
            $service = DB::table('services')->find($validated['service']);
            $serviceName = $service->name;
        }
        
        // Datos para el correo
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service' => $serviceName,
            'message' => $validated['message']
        ];
        
        // Enviar correo
        Mail::to(config('mail.to.address'))->send(new ContactFormMail($data));
        
        // Redirigir con mensaje de éxito
        return redirect()->route('contact')->with('success', 'Tu mensaje ha sido enviado. Nos pondremos en contacto contigo a la brevedad.');
    }
}