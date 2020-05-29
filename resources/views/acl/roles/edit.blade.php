{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Editar Perfil</div>

    <div class="card-body">

        <a class="text-success" href="{{route('role.index')}}">&leftarrow; Voltar para a listagem</a>

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-4" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <form action="{{route('role.update',['role'=>$role->id])}}" method="post" class="mt-4" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Insira o nome" name="name" value="{{ old('name') ?? substr($role->name,4) }}">
            </div>

            <div class="form-group">
              <label for="guard_name">Local</label>
              <select class="form-control" name="guard_name" id="guard_name">
                <option value="api" {{$role->guard_name==='api'?'selected':''}} >API</option>
                <option value="web" {{$role->guard_name==='web'?'selected':''}} >WEB</option>
              </select>
            </div>

            <button type="submit" class="btn btn-block btn-success">Atualizar Perfil</button>
        </form>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop