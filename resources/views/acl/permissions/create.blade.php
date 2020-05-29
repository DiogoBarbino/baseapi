{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Cadastrar Permissão</div>

    <div class="card-body">

        <a class="text-success" href="{{route('permission.index')}}">&leftarrow; Voltar para a listagem</a>

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-4" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <form action="{{route('permission.store')}}" method="post" class="mt-4" autocomplete="off">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Insira o nome" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
              <label for="guard_name">Local</label>
              <select class="form-control" name="guard_name" id="guard_name">
                <option value="api">API</option>
                <option value="web">WEB</option>
              </select>
            </div>

            <button type="submit" class="btn btn-block btn-success">Cadastrar Nova Permissão</button>
        </form>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop