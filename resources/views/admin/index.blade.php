@extends('home')

@section('titulo','Home')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Painel de Controle</div>
                    <div class="panel-body">
                        <div class="row azul col-md-2 well-sm center-block" style="margin-top: 1%;">
                            <p class="lead"></p>
                            <p><a class="btn btn-lg btn-primary center-block" href="{{route('idiomas.show')}}"
                                  role="button">Idiomas</a></p>
                        </div>

                        <div class="row azul col-md-2 well-sm center-block" style="margin-top: 1%;">
                            <p class="lead"></p>
                            <p><a class="btn btn-lg btn-primary center-block" href="{{route('frases.show')}}"
                                  role="button">Frases</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
