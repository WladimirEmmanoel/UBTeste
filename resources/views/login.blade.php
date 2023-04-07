@extends('template')

@section('content')
    <h1 class="title">Autenticação</h1>
    <p class="desc">Informe abaixo seu CPF e Senha para fazer login no sistema da unibra.</p>
    
    <div id="mensagem"></div>

    <form class="form" id="form-login" action="{{ route('logar')}}" method="POST">
        @csrf
        <label for="cpf" class="label-title">CPF</label>
        <input type="text" id="cpf" name="cpf" required maxlength="14">

        <label for="password" class="label-title">Senha</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn-form">Entrar</button>
    </form>

    <a href="{{ route('recuperar_senha')}}" class="btn-navigation">Recuperar minha senha</a>

@endsection
                