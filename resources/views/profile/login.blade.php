@extends('layouts.autentication')
@section('title','Login')
@section('content')
<div class="registro d-flex justify-content-center">
    <h1>Login</h1>
    <form method="POST" action="/login">
        @csrf
        <div class="col-12">
            <div class="form-group">
                <label for="username_email" class="col-form-lavel">Email:</label>
                <input class="form-control @error('username_email') is-invalid @enderror" type="text" id="username_email" name="username_email" value="{{ old('username_email') }}" required placeholder="Seu email" />
                @error('username_email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="password" class="col-form-lavel">Senha:</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required placeholder="Sua senha" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="justify-content-center">
            <button type="submit" class="btn btn-primary">Logar</button>
        </div>
    </form>
    <p>
        Não tem uma conta? <a href="/register">Registre-se aqui</a>
    </p>
</div>
@endsection
