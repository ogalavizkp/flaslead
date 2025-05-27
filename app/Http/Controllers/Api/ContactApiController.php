<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactApiController extends Controller
{
    /**
     * Busca un contacto por número en phone, phone2 o phone3.
     * Si no existe, lo crea con phone y account_id.
     * Devuelve el nombre o 'Estimado usuario'.
     */
    public function lookupOrCreate(Request $request)
    {
        $phone = $request->input('phone');
        $accountId = $request->input('account');

        // Validación básica
        if (!$phone || !$accountId) {
            return response()->json([
                'error' => 'Faltan datos requeridos: phone y account'
            ], 400);
        }

        // Buscar contacto existente por cualquier campo de número
        $contact = Contact::where('phone', $phone)
            ->orWhere('phone2', $phone)
            ->orWhere('phone3', $phone)
            ->first();

        // Devolver nombre si tiene, o texto genérico
        $name = $contact->first_name ?? 'Estimado usuario';
        $lastname = $contact->last_name ?? '';
        $names = $name .' '. $lastname;
          
        // Si no existe, crear nuevo contacto
        if (!$contact) {
            $contact = Contact::create([
                'phone' => $phone,
                'first_name' => $names,
                'account_id' => $accountId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }



        return response()->json([
            'name' => $name,
            'lastname' => $lastname
        ]);
    }
}
