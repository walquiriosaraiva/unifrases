@extends('home')

@section('titulo','Consulta Idiomas')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Consulta Idiomas</div>
                    <div class="panel-body">
                        <form action="{{route('idiomas.pesquisa')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="usuario">Idioma</label>
                                    <input type="text" class="form-control" name="idioma" id="idioma"
                                           placeholder="Idioma" value="{{ $inputs['idioma'] ?? '' }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12">

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
                                            class="btn btn-success btn-lg btn-create col-md-3 col-md-offset-4">
                                        <span class="glyphicon glyphicon-plus"></span> Idioma
                                    </button>
                                </a>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped bunitu table-bordered" id="grideidiomas">
                                        <thead>
                                        <div class="col col-xs-12 text-right">
                                            <a href="{{route('idiomas.create')}}">
                                                <button type="button" class="btn btn-sm btn-success btn-create">
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
                                    {{ $idiomas->render() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <script>
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getUsers(page);
                }
            }
        });
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (e) {
                getUsers($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });

        function getUsers(page) {
            $.ajax({
                url: '?page=' + page,
                dataType: 'json',
            }).done(function (data) {
                $('#grideidiomas').html(data);
                location.hash = page;
            }).fail(function () {
                alert('Falha ao carregar usuarios.');
            });
        }
    </script>
@endsection