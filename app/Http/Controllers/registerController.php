<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller
{
    public function register(){
        return view("register");
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $validator->setCustomMessages([
            'name' => 'Nombre invalido',
            'email.required' => 'El campo "email" es obligatorio.',
            'email.email' => 'El campo "email" debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo ya esta siendo utilizado',
            'password.required' => 'El campo "contraseña" es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => strtoupper($request->nombres . ' ' . $request->apellidos),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        return to_route('login')->with('status', 'Tu cuenta ha sido creada, espera que sea validada por uno de los administradores');

    }
}
