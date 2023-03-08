@extends('layouts.autentication')
@section('title','Registro')
@section('content')
<div class="registro d-flex justify-content-center">
    <h1>Registro</h1>
    <form method="POST" action="/register">
        @csrf
        <div class="col-12">
            <div class="form-group">
                <label for="nickname" class="col-form-lavel">Nome do Usuario:</label>
                <input class="form-control @error('nickname') is-invalid @enderror" type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required autofocus placeholder="Seu nome de usuario" />
                @error('nickname')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="email" class="col-form-lavel">Email:</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Seu email" />
                @error('email')
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
        <div class="col-12">
            <div class="form-group">
                <label for="name" class="col-form-lavel">Seu nome:</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="nome" name="nome" value="{{ old('nome') }}" required autofocus placeholder="Nome visivel para as pessoas" />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="justify-content-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </form>
    <p>
        Já está registrado? <a href="/login">Fazer login</a>
    </p>
    <p>Ou registre-se com:</p>
</div>

@endsection
