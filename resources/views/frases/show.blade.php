@extends('home')

@section('titulo','Consulta Frases')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Consulta Frases</div>
                    <div class="panel-body">
                        <form action="{{route('frases.pesquisa')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" name="codigo" id="codigo"
                                           placeholder="Código" value="{{ isset($inputs['codigo']) && $inputs['codigo'] ? $inputs['codigo'] : '' }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="idioma" class="control-label">Idioma</label>
                                    <select class="form-control" data-live-search="true" id="idioma"
                                            name="idioma"
                                            title="Idioma">
                                        <option value="">--selecione--</option>
                                        @foreach($idiomas as $key=>$value)
                                            @if(old('idioma'))
                                                {{ $idiomaEntrada = old('idioma') }}
                                            @else
                                                {{ $idiomaEntrada = '' }}
                                            @endif
                                                <option data-toggle="{{$value->imagem}}"
                                                    value="{{ $value->id }}" {{ $idiomaEntrada == $value->id ? 'selected' : ''}}> {{ $value->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="texto">Texto</label>
                                    <input type="text" class="form-control" name="texto" id="texto"
                                           placeholder="Texto" value="{{ isset($inputs['texto']) && $inputs['texto'] ? $inputs['texto'] : '' }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            @if(file_exists('uploads/unifrases.xls'))
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    <button type="button" class="btn btn-info" id="processaPlanilha"
                                            name="processaPlanilha">Processar planilha
                                    </button>

                                </div>


                            @endif
                            @if(session('inser') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    A frase {{ session("frase") }} foi adicionado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('planilha') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    {{ session("frase") }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('update') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    A frase {{ session("frase") }} foi atualizado.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('delete') == true)
                                <div class="alert alert-success">
                                    <strong>Sucesso!</strong>
                                    A frase {{ session('frase') }} foi removido.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if($count == 0)
                                <div class="alert alert-danger btn-lg col-md-10 col-md-offset-1 danger">
                                    Você não possui nenhuma frase cadastrada.
                                </div>

                                <a href="{{route('frases.create')}}">
                                    <button type="button"
                                            class="btn btn-success btn-lg btn-create col-md-3 col-md-offset-4">
                                        <span class="glyphicon glyphicon-plus"></span> Frase
                                    </button>
                                </a>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped bunitu table-bordered" id="grideidiomas">
                                        <thead>
                                        <div class="col col-xs-12 text-right">
                                            <a href="{{route('frases.create')}}">
                                                <button type="button" class="btn btn-sm btn-success btn-create">
                                                    <span class="glyphicon glyphicon-plus"></span> Frase
                                                </button>
                                            </a>
                                        </div>
                                        <tr>
                                            <th>Id</th>
                                            <th>Código</th>
                                            <th>Idioma</th>
                                            <th>Texto</th>
                                            <th>Status</th>
                                            <th class="text-center">Ação</th>
                                        </tr>
                                        </thead>
                                        @foreach($frases as $frase)
                                            <tr>
                                                <td>{{$frase->id}}</td>
                                                <td>{{$frase->codigo}}</td>
                                                <td>{{$frase->idioma}}</td>
                                                <td>{{$frase->texto}}</td>
                                                <td>{{$frase->status == 'A' ? 'Ativo' : 'Inativo'}}</td>
                                                <td class="text-center">
                                                    <a class='btn btn-info btn-xs'
                                                       href="{{ route('frases.edit', $frase->id )}}">
                                                        <span class="glyphicon glyphicon-edit"></span> Editar
                                                    </a>
                                                    <a onclick="return confirm('Deseja excluir esse registro?')"
                                                       href="{{ route('frases.delete', $frase->id )}}"
                                                       class="btn btn-danger btn-xs">
                                                        <span class="glyphicon glyphicon-remove"></span> Excluir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    {{ $frases->render() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#idioma").select2({
                templateResult: format,
                templateSelection: formatState,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            $("#processaPlanilha").click(function () {
                $('#processaPlanilha').html("<div class='loader'></div>");
                var form_data = new FormData();
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "{{ route('processa.planilha') }}",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#processaPlanilha').html("Processar planilha");
                        if (response === true) {
                            $('#processaPlanilha').addClass('hide');
                        } else {
                            $('#processaPlanilha').removeClass('hide');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#processaPlanilha').html("Processar planilha");
                    }
                });
            })
        });

    </script>

@endsection