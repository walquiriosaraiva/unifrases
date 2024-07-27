@extends('home')

@section('titulo','Consulta Idiomas')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Consulta Idiomas</div>
                    <div class="panel-body">
                        <div class="row col-md-10 col-md-offset-1 custyle">

                            @if(session('inser') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    O Idioma {{ session("idioma") }} foi adicionado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('update') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    O Idioma {{ session("idioma") }} foi atualizado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('delete') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    O Idioma {{ session('idioma') }} foi removido.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if($count == 0)
                                <div class="alert alert-danger btn-lg col-md-10 col-md-offset-1 danger">
                                    Você não possui nenhum idioma cadastrada.
                                </div>

                                <a href="{{route('idiomas.create')}}">
                                    <button type="button"
                                            class="btn btn-primary btn-lg btn-create col-md-3 col-md-offset-4">
                                        <span class="glyphicon glyphicon-plus"></span> Idioma
                                    </button>
                                </a>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped bunitu table-bordered" id="grideidiomas">
                                        <thead>
                                        <div class="col col-xs-12 text-right">
                                            <a href="{{route('idiomas.create')}}">
                                                <button type="button" class="btn btn-sm btn-primary btn-create">
                                                    <span class="glyphicon glyphicon-plus"></span> Idioma
                                                </button>
                                            </a>
                                        </div>
                                        <tr>
                                            <th>Id</th>
                                            <th>Imagem</th>
                                            <th>Nome</th>
                                            <th>Encoding</th>
                                            <th>Collateaux</th>
                                            <th>Status</th>
                                            <th class="text-center">Ação</th>
                                        </tr>
                                        </thead>
                                        @foreach($idiomas as $idioma)
                                            <tr>
                                                <td>{{$idioma->id}}</td>
                                                <td>
                                                    @if($idioma->imagem)
                                                        <img src="/img/idiomas/{{$idioma->imagem}}"
                                                             style="width: 40px !important; height: 40px !important;">
                                                    @endif
                                                </td>
                                                <td>{{$idioma->nome}}</td>
                                                <td>{{$idioma->encoding}}</td>
                                                <td>{{$idioma->collateaux}}</td>
                                                <td>{{$idioma->status == 'A' ? 'Ativo' : 'Inativo'}}</td>
                                                <td class="text-center">
                                                    <a class='btn btn-info btn-xs'
                                                       href="../editar/idiomas/{{$idioma->id}}">
                                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                                    </a>
                                                    <a onclick="return confirm('Deseja excluir esse registro?')"
                                                       href="../deletar/idiomas/{{$idioma->id}}"
                                                       class="btn btn-danger btn-xs">
                                                        <span class="glyphicon glyphicon-remove"></span> Excluir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection