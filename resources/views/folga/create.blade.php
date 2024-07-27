@extends('home')

@section('titulo','Cadastrar Folga')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar Folga</div>
                    <div class="panel-body">
                        <form class="form-horizontal col-md-10 col-md-offset-1" role="form" action="{{route('idioma.store')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group col-md-10{{ $errors->has('data') ? ' has-error' : '' }}">
                                <label for="data" class="control-label">Imagem: </label>
                                    <input id="data" type="date" class="form-control" name="data" value="{{ old('imagem') }}">
                                    @if ($errors->has('data'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('data') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group col-md-10">
                                {!! csrf_field() !!}
                                <button type="submit" class="control-label btn btn-primary">Cadastrar</button>
                                <a class="control-label btn btn-danger" href="{{route('admin')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection