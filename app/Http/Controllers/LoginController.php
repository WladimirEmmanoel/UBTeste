<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){

        //Se a sessão do usuário ainda estiver ativa, redireciona para dashboard
        if (session('usuario')) {
            return redirect()->route('dashboard');
        } else {
            return view('login');
        }
    }

    public function logar(Request $request){
    
        //Armazena os dados do form
        $cpf = str_replace(['.', '-'], '', $request->input('cpf'));
        $password = $request->input('password');

        //Verifica se o usuário existe, e armazena 
        $usuario = Usuario::where('cpf', $cpf)->first();
        if (!$usuario) {
            return response()->json(['error' => true,'message' => 'Usuário não encontrado!', 400]);
        }      

        // Verifica se a senha informada é a correta
        if (!Hash::check($password, $usuario->password)) {
            return response()->json(['error' => true, 'message' => 'Senha incorreta!', 400]);
        }

        // Inicia a sessão e redireciona o usuário
        session()->put('usuario', $usuario);
        return response()->json(['success' => true, 'message' => 'Login efetuado com SUCESSO, Redirecionando...', 200]);
    }
}
