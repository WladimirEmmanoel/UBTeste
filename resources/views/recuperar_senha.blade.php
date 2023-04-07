@extends('template')

@section('content')
    <h1 class="title">Recuperar Senha</h1>
    <p class="desc">Informe abaixo seu CPF e Senha para recuperar sua senha,
enviaremos um link para o email cadastrado.</p>

    <div id="mensagem"></div>

    <form action="{{ route('recover_password')}}" method="POST" class="form" id="form-recover-password">
        @csrf
        <label for="cpf" class="label-title">CPF</label>
        <input type="text" id="cpf" name="cpf" required maxlength="14">

        <button type="submit" class="btn-form">Enviar</button>
    </form>

    <a href="{{ route('login') }}" class="btn-navigation">Voltar</a>
@endsection
                