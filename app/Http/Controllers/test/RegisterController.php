<?php

namespace App\Http\Controllers;

use DateInterval;
use App\Models\User;
use App\Models\Titulares;
use Nette\Utils\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function register(){
        return view("register");
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'dia' => ['required', 'integer','min:0','max:31'],
            'mes' => ['required', 'integer','min:0','max:12'],
            'anno' => ['required', 'integer','min:' . (new DateTime())->sub(new DateInterval('P100Y'))->format('Y'),'max:' . (new DateTime())->sub(new DateInterval('P18Y'))->format('Y')],
            'cedula' => ['required', 'integer','min:0','max:50000000'],
            'telefono_numero' => ['required', 'integer','min:0'],
            'manzana' => ['required', 'integer','min:1','max:22'],
            'casa' => ['required', 'integer','min:0','max:50'],
        ]);

        $validator->setCustomMessages([
            'nombres.required' => 'El campo "nombres" es obligatorio',
            'nombres.max' => 'El nombre no debe tener mas de 255 letras',
            'apellidos.required' => 'El campo "apellidos" es obligatorio',
            'apellidos.max' => 'El apellidos no debe tener mas de 255 letras',
            'email.required' => 'El campo "email" es obligatorio.',
            'email.email' => 'El campo "email" debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo ya esta siendo utilizado',
            'password.required' => 'El campo "contraseña" es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'dia.required' => 'El campo "dia" es requerido',
            'mes.required' => 'El campo "mes" es requerido',
            'anno.required' => 'El campo "año" es requerido',
            'dia' => 'Dia inválido',
            'mes' => 'Mes debe ser un numero entre 1 y 12',
            'anno' => 'Año inválido',
            'cedula.required' => 'El campo "cedula" es requerido',
            'cedula' => 'Numero de cedula invalido',
            'telefono_numero.required' => 'El campo "telefono" es requerido',
            'telefono_numero' => 'Numero de telefono invalido',
            'manzana' => 'Numero de manzana invalido',
            'casa' => 'Numero de casa invalido'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => strtoupper($request->nombres . ' ' . $request->apellidos),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $id = User::where('email','=', $request->input('email'))->first()->id;

        $fecha = Carbon::create(
            $request->anno,
            $request->mes,
            $request->dia
        );

        Titulares::create([
            'usuario_id' => $id,
            'nombres' => strtoupper($request->nombres),
            'apellidos' => strtoupper($request->apellidos),
            'manzana' => $request->manzana,
            'casa' => $request->casa,
            'telefono' => $request->telefono_prefijo.$request->telefono_numero,
            'cedula' => $request->cedula,
            'fecha_de_nacimiento' => $fecha,
            'saldo_positivo' => "0",
        ]);

        return to_route('login')->with('status', 'Tu cuenta ha sido creada, espera que sea validada por uno de los administradores');

    }
}
