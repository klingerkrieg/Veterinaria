@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vacinas</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('vacinas') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="search" class="col-md-1 col-form-label text-md-end">Buscar</label>

                            <div class="col-md-5">
                                <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}">
                            </div>

                            <button type="submit" class="col-md-2 btn btn-primary">
                                Pesquisar
                            </button>

                            <a href="{{route("vacinas-new")}}" class="col-md-2 btn btn-secondary mx-1 pt-3">
                                Novo
                            </a>
                        </div>
                    </form>


                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Validade (Meses)</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($listagem as $item)
                                <tr>
                                    <td scope="row">
                                        <a href="{{route("vacinas-edit",$item)}}">Editar</a>
                                    </td>
                                    <td>{{$item->nome}}</td>
                                    <td>{{$item->validade_meses}}</td>
                                    <td>

                                        <form action="{{route('vacinas-delete',$item)}}" method="post"
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
