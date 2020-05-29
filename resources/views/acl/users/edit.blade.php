{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Cadastrar Usuário</div>

    <div class="card-body">

        <a class="text-success" href="{{route('user.index')}}">&leftarrow; Voltar para a listagem</a>

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-4" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <form action="{{route('user.update',['user'=>$user->id])}}" method="post" class="mt-4" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Insira o nome" name="name" value="{{ old('name')?? $user->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Insira o email" name="email" value="{{ old('email') ?? $user->email}}">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Insira a senha" name="password">
            </div>

            <button type="submit" class="btn btn-block btn-success">Salvar Alteração</button>
        </form>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop