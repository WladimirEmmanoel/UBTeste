<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //Retorna a página de cadastro
    public function view_cadastro(){
        return view('cadastrar');
    }

    public function cadastrar(Request $request){
            
        $dados = $request->all();
        $dados['cpf'] = str_replace(['.', '-'], '', $request->input('cpf'));

        //Verifica se houve erro
        $validator = Validator::make($dados, [
            'name' => 'required|max:255',
            'cpf' => 'required|digits:11|unique:usuarios',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Se algum dado não passar na validação, exibe a mensagem de erro
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Verifique seus dados e tente novamente!'], 400);
        }

        //Cria o Objeto para armazena os dados do usuário
        $usuario = new Usuario;
        $usuario->name = $dados['name'];
        $usuario->cpf = $dados['cpf'];
        $usuario->email = $dados['email'];
        $usuario->password = bcrypt($dados['password']);
        
        //Armaazena o usuário no banco
        if ($usuario->save()) {
            return response()->json(['success' => true, 'message' => 'Usuário cadastrado com sucesso!'], 200);
        } else {
            $errors = $usuario->errors()->all();
            return response()->json(['error' => true, 'message' => 'Erro ao cadastrar usuário.', 'errors' => $errors], 422);
        }
    }
}
