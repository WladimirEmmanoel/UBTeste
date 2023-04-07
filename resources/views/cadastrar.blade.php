@extends('template')

@section('content')
    <h1 class="title">Cadastro</h1>
    <p class="desc">Informe os dados abaixo para poder se cadastrar no sistema.</p>

    <div id="mensagem"></div>

    <form action="{{ route('cadastrar')}}" method="POST" class="form" id="form-cadastro">
        @csrf
        <label for="name" class="label-title">Nome Completo</label>
        <input type="text" id="name" name="name" required>
        
        <label for="cpf" class="label-title">CPF</label>
        <input type="text" id="cpf" name="cpf" required maxlength="14">

        <label for="email" class="label-title">Email</label>
        <input type="text" id="email" name="email" required>

        <label for="password" class="label-title">Senha</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn-form">Cadastrar</button>
    </form>

    <a href="{{ route('login') }}" class="btn-navigation">Voltar</a>

@endsection
                