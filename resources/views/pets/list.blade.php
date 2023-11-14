@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pets</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('pets') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="search" class="col-md-1 col-form-label text-md-end">Buscar</label>

                            <div class="col-md-5">
                                <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}">
                            </div>

                            <button type="submit" class="col-md-2 btn btn-primary">
                                Pesquisar
                            </button>
                            @can('veterinario-access')
                            <a href="{{route("pets-new")}}" class="col-md-1 btn btn-secondary mx-1">
                                Novo
                            </a>
                            @endcan
                        </div>
                    </form>


                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Espécie</th>
                            <th scope="col">Dono</th>
                            <th scope="col">Vacinações</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($listagem as $item)
                                <tr>
                                    <td scope="row">
                                        <a href="{{route("pets-edit",$item)}}">Editar</a>
                                    </td>
                                    <td>{{$item->nome}}</td>
                                    <td>{{$especies[$item->especie_id]}}</td>
                                    <td>{{$item->dono->name}}</td>
                                    <td>{{count($item->vacinacoes)}}</td>
                                    @can('veterinario-access')
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
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <td colspan="10">
                                {{ $listagem->links() }}
                            </td>
                        </tfoot>
                    </table>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
