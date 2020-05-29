{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">

        <a class="text-success" href="{{route('user.index')}}">&leftarrow; Voltar para a listagem</a>

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-4" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <h2 class="mt-4">Perfis para: {{$user->name}}</h2>

        <form action="{{route('user.rolesSync',['user'=>$user->id])}}" method="post" class="mt-4" autocomplete="off">
            @csrf
            @method('PUT')

             @foreach($roles as $role)
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="roles[]" value="{{$role->id}}" {{($role->can)?'checked':''}}>
                {{$role->name}}
              </label>
            </div>
            @endforeach

            <button type="submit" class="btn btn-block btn-success mt-4">Sincronizar Perfil</button>
        </form>
    </div>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop