@extends('home')

@section('titulo','Cadastrar Idioma')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar Idioma</div>
                    <div class="panel-body">
                        <form class="form-horizontal col-md-10 col-md-offset-1" role="form"
                              action="{{route('idiomas.store')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group col-md-12{{ $errors->has('imagem') ? ' has-error' : '' }}">
                                <label for="imagem" class="control-label">Imagem: </label>
                                <input id="imagem" type="text" class="form-control" name="imagem"
                                       value="{{ old('imagem') }}">
                                @if ($errors->has('imagem'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('imagem') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome" class="control-label">Nome: </label>
                                <input id="nome" type="text" class="form-control" name="nome"
                                       value="{{ old('nome') }}">
                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('encoding') ? ' has-error' : '' }}">
                                <label for="encoding" class="control-label">Encoding: </label>
                                <input id="encoding" type="text" class="form-control" name="encoding"
                                       value="{{ old('encoding') }}">
                                @if ($errors->has('encoding'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('encoding') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('collateaux') ? ' has-error' : '' }}">
                                <label for="collateaux" class="control-label">Collateaux: </label>
                                <input id="collateaux" type="text" class="form-control" name="collateaux"
                                       value="{{ old('collateaux') }}">
                                @if ($errors->has('collateaux'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('collateaux') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-10">
                                {!! csrf_field() !!}
                                <button type="submit" class="control-label btn btn-primary">Incluir</button>
                                <a class="control-label btn btn-danger" href="{{route('idiomas.show')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection