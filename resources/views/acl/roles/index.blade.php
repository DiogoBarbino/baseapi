{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Controle de Perfis</div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <a class="text-success" href="{{route('role.create')}}">&plus; Cadastrar Perfil</a>

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger mt-4" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td class="d-flex">
                        <a class="mr-3 btn btn-sm btn-outline-success" href="{{route('role.edit',['role'=>$role->id])}}">Editar</a>
                        <a class="mr-3 btn btn-sm btn-outline-info" href="{{route('role.permissions',['role'=>$role->id])}}">Permissões</a>
                        <form action="{{route('role.destroy',['role'=>$role->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop