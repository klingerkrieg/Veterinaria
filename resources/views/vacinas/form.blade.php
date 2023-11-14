@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vacinas</div>

                <div class="card-body">

                    @if ($data->exists)
                        <form method="POST" action="{{ route('vacinas-update', $data) }}" id="main">
                            @csrf
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('vacinas-insert') }}" id="main">
                            @csrf
                    @endif


                        
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
                            <label for="validade_meses" class="col-md-3 col-form-label text-md-end">
                                Validade (Meses)<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="validade_meses" type="numeric" class="date form-control @error('validade_meses') is-invalid @enderror" 
                                    name="validade_meses" value="{{ old('validade_meses',$data->validade_meses) }}" >

                                @error('validade_meses')
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
                        
                            <a href="{{route("vacinas-new")}}" class="col-sm-2 btn btn-secondary">
                                Novo
                            </a>
                        
                            <a href="{{route("vacinas")}}" class="col-sm-3 btn btn-secondary">
                                Listagem
                            </a>

                            @if ($data->exists)
                            <form action="{{route('vacinas-delete',$data)}}" method="post"
                                class="col-sm-3">
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
