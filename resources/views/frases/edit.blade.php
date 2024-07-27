@extends('home')

@section('titulo','Editar Frase')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Frase</div>
                    <div class="panel-body">
                        <form class="form-horizontal col-md-10 col-md-offset-1" role="form"
                              action="{{route('idiomas.update')}}" method="post">
                            {{ csrf_field() }}

                            <input type="hidden" id="id" name="id" value="{{$frase->id}}">

                            <div class="form-group col-md-12{{ $errors->has('codigo') ? ' has-error' : '' }}">
                                <label for="codigo" class="control-label">Imagem: </label>
                                <input id="codigo" type="text" class="form-control" name="codigo"
                                       value="{{$frase->codigo}}">
                                @if ($errors->has('codigo'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('codigo') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-10{{ $errors->has('idioma') ? ' has-error' : '' }}">
                                <label for="idioma" class="control-label">Idioma: </label>
                                <select class="form-control" data-live-search="true" id="idioma"
                                        name="idioma">
                                    <option data-tokens="ketchup mustard" value="">Selecione</option>
                                    @foreach($idiomas as $key=>$value)
                                        <option data-tokens="ketchup mustard"
                                                value="{{ $value->id }}" {{ $frase->idioma == $value->id ? 'selected' : ''}}> {{ $value->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('texto') ? ' has-error' : '' }}">
                                <label for="texto" class="control-label">Texto: </label>
                                <input id="texto" type="text" class="form-control" name="codigo"
                                       value="{{$frase->texto}}">
                                @if ($errors->has('texto'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('texto') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-10">
                                {!! csrf_field() !!}
                                <button type="submit" class="control-label btn btn-primary">Alterar</button>
                                <a class="control-label btn btn-danger" href="{{route('frases.show')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table table-striped bunitu table-bordered" id="grideidiomas">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Código</th>
                                <th>Idioma</th>
                                <th>Texto</th>
                                <th>Status</th>
                                <th class="text-center">Ação</th>
                            </tr>
                            </thead>
                            @foreach($frases as $fraseGride)
                                <tr>
                                    <td>{{$fraseGride->id}}</td>
                                    <td>{{$fraseGride->codigo}}</td>
                                    <td>{{$fraseGride->idioma}}</td>
                                    <td>{{$fraseGride->texto}}</td>
                                    <td>{{$fraseGride->status == 'A' ? 'Ativo' : 'Inativo'}}</td>
                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs'
                                           href="{{ route('frases.edit', $fraseGride->id )}}">
                                            <span class="glyphicon glyphicon-edit"></span> Editar
                                        </a>
                                        <a onclick="return confirm('Deseja excluir esse registro?')"
                                           href="{{ route('frases.delete', $fraseGride->id )}}"
                                           class="btn btn-danger btn-xs">
                                            <span class="glyphicon glyphicon-remove"></span> Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection