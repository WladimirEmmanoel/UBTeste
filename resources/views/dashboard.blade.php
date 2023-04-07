@extends('template')

@section('style')
    <style>
        .box-info::before {
            background-color: #1EE932;
        }
    </style>
@endsection

@section('content')
    <div class="content-dashboard">
        <h1 class="title">Dashboard</h1>
        <p class="desc">Parabéns, você está logado no sistema de testes</p>

        <div id="mensagem"></div>

        <div class="mensagem">Olá <span>{{ $nome }}</span>,seja bem vindo(a) de volta!</div>

        <a href="{{ route('alterar_senha') }}" class="btn-form">Mudar Senha</a>

        <a href="{{ route('logout') }}" class="btn-navigation">Sair</a>
    <div>
@endsection
                