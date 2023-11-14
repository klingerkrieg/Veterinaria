@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pets</div>

                <div class="card-body">

                    @if ($data->exists)
                        <form method="POST" action="{{ route('pets-update', $data) }}" id="main" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('pets-insert') }}" id="main" enctype="multipart/form-data">
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
                            <label for="foto" class="col-md-3 col-form-label text-md-end">
                                Foto</label>

                            <div class="col-md-6">
                                @can('veterinario-access')
                                <input id="foto" type="file" class="date form-control @error('foto') is-invalid @enderror" 
                                    name="foto">
                                @endcan

                                @if ($data->exists && $data->foto != "")
                                    <img src="{{asset($data->foto)}}" class="rounded" width='200'/>
                                @endif
                                

                                @error('foto')
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

                            @can('veterinario-access')
                            <button type="submit" class="col-sm-2 btn btn-primary" form="main">
                                Salvar
                            </button>
                        
                            <a href="{{route("pets-new")}}" class="col-sm-2 btn btn-secondary">
                                Novo
                            </a>
                            @endcan
                        
                            <a href="{{route("pets")}}" class="col-sm-3 btn btn-secondary">
                                Listagem
                            </a>

                            @can('veterinario-access')
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
                            @endcan
                    
                        </div>


                    <h4>Vacinações</h4>

                    @can('veterinario-access')
                    <form method="POST" action="{{ route('vacinacoes-insert', $data) }}" id="vacinacoes">
                        @csrf

                        <div class="row mb-3">
                            <label for="vacina_id" class="col-md-3 col-form-label text-md-end">
                                Vacina<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <select id="vacina_id" class="form-control @error('vacina_id') is-invalid @enderror" name="vacina_id">
                                    <option></option>
                                    @foreach ($vacinas as $item)
                                        @php
                                            $selected = "";
                                            if ($item->id == old('vacina_id',$data->vacina_id)){
                                                $selected = "selected";
                                            }
                                        @endphp
                                        <option value={{$item->id}} {{$selected}}>{{$item->nome}}</option>
                                    @endforeach
                                </select>
                                
                                @error('vacina_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="data" class="col-md-3 col-form-label text-md-end">
                                Data<span class='red'>*</span></label>

                            <div class="col-md-6">
                                <input id="data" type="date" class="form-control @error('data') is-invalid @enderror" 
                                    name="data" value="{{ old('data',$data->data) }}" >

                                @error('data')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="data" class="col-md-3 col-form-label text-md-end">
                                Validade</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" readonly value="{{ $data->validade }}" >
                            </div>
                        </div>

                    </form>

                    <div class="d-grid gap-2 d-sm-flex offset-sm-3">
                        <button type="submit" class="col-sm-2 btn btn-primary" form="vacinacoes">
                            Salvar
                        </button>
                    </div>
                    @endcan

                    @if($data->exists)

                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Data</th>
                                <th scope="col">Validade</th>
                                <th scope="col">Veterinário</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->vacinacoes as $item)
                                    <tr>
                                        <td>{{$item->vacina->nome}}</td>
                                        <td>{{$item->data->format('d/m/Y')}}</td>
                                        <td>{{$item->validade->format('d/m/Y')}}</td>
                                        <td>{{$item->veterinario->name}}</td>
                                        @can('veterinario-access')
                                        <td>
                                            <form action="{{route('vacinacoes-delete',$item)}}" method="post"
                                                class="d-grid col-sm-2">
                                                @csrf
                                                @method("DELETE")
                                                <a href="#" 
                                                    onclick="main.confirmDeleteModal(this,'{{$item->vacina->nome}} ({{$item->data->format('d/m/Y')}})')">
                                                    Excluir
                                                </a>
                                            </form>
                                        </td>
                                        @endcan
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
