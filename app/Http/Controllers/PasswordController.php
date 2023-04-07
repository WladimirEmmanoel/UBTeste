<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Mail\RecuperarSenha;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PasswordController extends Controller
{

    public function alterar_senha(){
        
        //Se o usuário estiver logado, retornar a página de Alterar Senha
        if(session('usuario')){
            $usuario = session('usuario');
            return view('alterar_senha');
        } else {
            return redirect()->route('login');
        }
    }

    //Retorna a Página de Recuperar Senha
    public function recuperar_senha(){
        return view('recuperar_senha');
    }

    public function changePassword(Request $request){

        //Recupera os dados do Formulário
        $form = $request->all();
        
        //Verifica se as senhas são iguais
        if($form['password'] !== $form['confirmation_password']){
            return response()->json(['error' => true, 'message' => 'As senhas informadas não coincidem'], 400);
        }

        //Recupera o usuário da sessão e sobreescreve a senha
        $usuario = session('usuario');
        $usuario['password'] = bcrypt($form['password']);

        //Atualiza o usuário e rediciona para Dashboard
        if($usuario->update()){
            return response()->json(['success' => true, 'message' => 'Senha atualizada com sucesso, redirecionando...'], 200);
        } else {
            return response()->json(['error' => true,'message' => 'Erro ao alterar a senha, atualize a página e tente novamente.'], 422);
        }
    }

    public function recoverPassword(Request $request){

        //Remove os caracteres do CPF
        $cpf = str_replace(['.', '-'], '', $request->input('cpf'));

        //Verifica se CPF é Válido
        $validator = Validator::make(
            ['cpf' => $cpf], 
            ['cpf' => 'required|digits:11']
        );

        //Valida o CPF informado
        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Informe o CPF corretamente!'], 400);
        }

        //Armazena o Usuário
        $usuario = Usuario::where('cpf', $cpf)->first();

        //Valida se o Usuário Existe
        if(!$usuario){
            return response()->json(['error' => true, 'message' => 'Usuário não encontrado', 400]);
        } 
        //Valida se o Usuário está cadastrado
        if(!$usuario->email){
            return response()->json(['error' => true, 'message' => 'Ocorreu um erro inexperado, entre em contato com o suporte!', 400]);
        } 

        //Gera a nova senha do usuário
        $novasenha = Str::random(8);
        $usuario->password = bcrypt($novasenha);
        
        //Atualiza a senha do usuário e envia o e-mail de recuperação de senha
        if ($usuario->save()) {
            $usuario->password = $novasenha;
            Mail::to($usuario->email)->send(new RecuperarSenha($usuario));
            return response()->json(['success' => true, 'message' => 'Senha enviada com sucesso!!!', 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'Ocorreu um erro inexperado, tente novamente', 400]);
        }
    }
}
