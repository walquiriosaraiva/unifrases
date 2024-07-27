@extends('home')

@section('titulo','Cadastrar Frase')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar Frase</div>
                    <div class="panel-body">
                        <form class="form-horizontal col-md-10 col-md-offset-1" role="form"
                              action="{{route('frases.store')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkplanilha" name="checkplanilha">
                                <label class="form-check-label" for="checkplanilha">Planilha excel?</label>
                            </div>

                            <div class="form-group col-md-12 hide" id="divplanilha">
                                <label for="planilha" class="control-label">Planilha: </label>
                                <input type="file" class="form-control-file" id="planilha" name="planilha">
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('codigo') ? ' has-error' : '' }}" id="divcodigo">
                                <label for="codigo" class="control-label">Código: </label>
                                <input id="codigo" type="text" class="form-control" name="codigo"
                                       value="{{ old('codigo') }}">
                                @if ($errors->has('codigo'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('codigo') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-10{{ $errors->has('idioma') ? ' has-error' : '' }}" id="dividioma">
                                <label for="idioma" class="control-label">Idioma: </label>
                                <select class="form-control" data-live-search="true" id="idioma"
                                        name="idioma">
                                    <option data-tokens="ketchup mustard" value="">Selecione</option>
                                    @foreach($idiomas as $key=>$value)
                                        <option data-tokens="ketchup mustard"
                                                value="{{ $value->id }}" {{ old('idioma') == $value->id ? 'selected' : ''}}> {{ $value->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12{{ $errors->has('texto') ? ' has-error' : '' }}" id="divtexto">
                                <label for="texto" class="control-label">Texto: </label>
                                <input id="texto" type="text" class="form-control" name="codigo"
                                       value="{{ old('codigo') }}">
                                @if ($errors->has('texto'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('texto') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-10">
                                {!! csrf_field() !!}
                                <button type="submit" class="control-label btn btn-primary">Incluir</button>
                                <a class="control-label btn btn-danger" href="{{route('frases.show')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#checkplanilha").click(function () {
                var checado = $("#checkplanilha").is(':checked');
                if(checado){
                    $('#divplanilha').removeClass('hide');
                    $('#divcodigo').addClass('hide');
                    $('#dividioma').addClass('hide');
                    $('#divtexto').addClass('hide');
                }
                else{
                    $('#divplanilha').addClass('hide');
                    $('#divcodigo').removeClass('hide');
                    $('#dividioma').removeClass('hide');
                    $('#divtexto').removeClass('hide');
                }
            })

        });
        // madereira constroi
        // chacara 97 lote 7 - mercado show de comprar - escola ensino 40

    </script>
@endsection