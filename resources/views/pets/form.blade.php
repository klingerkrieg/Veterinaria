@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pets</div>

                <div class="card-body">

                    @if ($data->exists)
                        <form method="POST" action="{{ route('pets-update', $data) }}" id="main">
                            @csrf
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('pets-insert') }}" id="main">
                            @csrf
                    @endif


                        <div class="row mb-3">
                            <label for="dono_id" class="col-md-3 col-form-label text-md-end">
                                Dono<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <select id="dono_id" class="form-control @error('dono_id') is-invalid @enderror" name="dono_id">
                                    <option></option>
                                    @foreach ($donos as $item)
                                        @php
                                            $selected = "";
                                            if ($item->id == old('dono_id',$data->dono_id)){
                                                $selected = "selected";
                                            }
                                        @endphp
                                        <option value={{$item->id}} {{$selected}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('dono_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="nome" class="col-md-3 col-form-label text-md-end">Nome<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" 
                                    name="nome" value="{{ old('nome',$data->nome) }}" autofocus>

                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nascimento" class="col-md-3 col-form-label text-md-end">
                                Nascimento<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="nascimento" type="text" class="date form-control @error('nascimento') is-invalid @enderror" 
                                    name="nascimento" value="{{ old('nascimento',$data->nascimento) }}" >

                                @error('nascimento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <label for="especie_id" class="col-md-3 col-form-label text-md-end">
                                Espécie<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <select id="especie_id" class="form-control @error('especie_id') is-invalid @enderror" name="especie_id">
                                    <option></option>
                                    @foreach ($especies as $key=>$tipo)
                                        @php
                                            $selected = "";
                                            if ($key == old('especie_id',$data->especie_id)){
                                                $selected = "selected";
                                            }
                                        @endphp
                                        <option value={{$key}} {{$selected}}>{{$tipo}}</option>
                                    @endforeach
                                </select>
                                
                                @error('especie_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </form>

                        <div class="d-grid gap-2 d-sm-flex offset-sm-3">

                            <button type="submit" class="col-sm-2 btn btn-primary" form="main">
                                Salvar
                            </button>
                        
                            <a href="{{route("pets-new")}}" class="col-sm-2 btn btn-secondary">
                                Novo
                            </a>
                        
                            <a href="{{route("pets")}}" class="col-sm-3 btn btn-secondary">
                                Listagem
                            </a>

                            @if ($data->exists)
                            <form action="{{route('pets-delete',$data)}}" method="post"
                                class="col-sm-2">
                                @csrf
                                @method("DELETE")
                                <a href="#" 
                                    class='btn btn-danger col-12'
                                    onclick="main.confirmDeleteModal(this,'{{$data->nome}}')">
                                    Excluir
                                </a>
                            </form>
                            @endif
                    
                        </div>
                    
                </div>                
            </div>            
        </div>
    </div>
</div>


@endsection
