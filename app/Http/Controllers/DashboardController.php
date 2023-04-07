<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard(){
        
        // Verifica se o usuário está autenticado
        if (session('usuario')) {
            
            //Armazena os dados da sessão
            $usuario = session('usuario');
            $nome = $usuario['name'];

            //Retorna a view e as informações desejadas
            return view('dashboard', ['nome' => $nome]);
        } 
        else {
            return redirect()->route('login');
        }
    }
    
    //Encerra a sessão do usuário e redireciona para o login
    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }
}
