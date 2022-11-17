<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuariosFormRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function registrar(UsuariosFormRequest $request)
    {
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function logar(UsuariosFormRequest $request)
    {
        $credenciais = $request->only(["email", "password"]);

        if(Auth::attempt($credenciais) === false){
            return response()->json("Usuário ou senha inválidos", 401);
        }

        $usuario = Auth::user();
        $token = $usuario->createToken('primeiro-token')->plainTextToken;

        return response()->json($token);
    }

    public function buscar(Request $request)
    {
        return User::all();
    }
}
