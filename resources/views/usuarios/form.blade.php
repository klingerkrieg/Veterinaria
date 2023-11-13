@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuários</div>

                <div class="card-body">

                    @if ($data->exists)
                        <form method="POST" action="{{ route('usuarios-update', $data) }}" id="main">
                            @csrf
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('usuarios-insert') }}" id="main">
                            @csrf
                    @endif

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$data->name) }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cpf" class="col-md-3 col-form-label text-md-end">CPF<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="cpf" type="cpf" class="cpf form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf',$data->cpf) }}">

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tipo" class="col-md-3 col-form-label text-md-end">Tipo de usuário<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo">
                                    @foreach ($tipos as $key=>$tipo)
                                        @php
                                            $selected = "";
                                            if ($key == old('tipo',$data->tipo)){
                                                $selected = "selected";
                                            }
                                        @endphp
                                        <option value={{$key}} {{$selected}}>{{$tipo}}</option>
                                    @endforeach
                                </select>
                                
                                @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$data->email) }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                    </form>

                        <div class="d-grid gap-2 d-sm-flex offset-sm-3">

                            <button type="submit" class="col-sm-2 btn btn-primary" form="main">
                                Salvar
                            </button>
                        
                            <a href="{{route("usuarios-new")}}" class="col-sm-2 btn btn-secondary">
                                Novo
                            </a>
                        
                            <a href="{{route("usuarios")}}" class="col-sm-3 btn btn-secondary">
                                Listagem
                            </a>

                            @if ($data->exists)
                            <form action="{{route('usuarios-delete',$data)}}" method="post"
                                class="col-sm-2">
                                @csrf
                                @method("DELETE")
                                <a href="#" 
                                    class='btn btn-danger col-12'
                                    onclick="main.confirmDeleteModal(this,'{{$data->name}}')">
                                    Excluir
                                </a>
                            </form>
                            @endif
                    
                        </div>

                        @if($data->exists)

                        <h4>Pets
                            <a href="{{route("pets-new-com-user",$data)}}">Adicionar novo</a>
                        </h4>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Espécie</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->pets as $item)
                                    <tr>
                                        <td scope="row">
                                            <a href="{{route("pets-edit",$item)}}">Editar</a>
                                        </td>
                                        <td>{{$item->nome}}</td>
                                        <td>{{$especies[$item->especie_id]}}</td>
                                        <td>
    
                                            <form action="{{route('pets-delete',$item)}}" method="post"
                                                class="d-grid col-sm-2">
                                                @csrf
                                                @method("DELETE")
                                                <a href="#" 
                                                    onclick="main.confirmDeleteModal(this,'{{$item->nome}}')">
                                                    Excluir
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @endif
                    
                </div>                
            </div>            
        </div>
    </div>
</div>


@endsection
