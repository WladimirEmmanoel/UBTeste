@extends('template')

@section('content')
    <h1 class="title">Alterar Senha</h1>
    <p class="desc">Informe abaixo sua nova senha</p>

    <div id="mensagem"></div>

    <form action="{{ route('change_password')}}" method="POST" class="form" id="form-change-password">
        @csrf
        @method('PUT')
        <label for="password" class="label-title">Nova senha</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmation-password" class="label-title">Confirme a nova senha</label>
        <input type="password" id="confirmation_password" name="confirmation_password" required>

        <button type="submit" class="btn-form">Atualizar senha</button>
    </form>

@endsection
                