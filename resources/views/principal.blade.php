@section('titulo','Unifrases')
        <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('titulo') </title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/home2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.modif.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"/>

    <script scr="{{asset('js/Auxiliar.js')}}"></script>
<!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156704144-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-156704144-1');
    </script>
</head>

<body>
<div class="container-fluid well-lg"
     style="background-image: linear-gradient(to bottom,#D9EAF0 0,#D9EAF0 100%); background-repeat: repeat-x; border-color: #D9EAF0;">
    @include('menu')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body alert-info">
                    <div class="row form-group">
                        {{ csrf_field() }}
                        <div class="col-md-3">
                            <label for="idiomaEntrada" class="control-label">1º) Idioma de Entrada <br>(choose your language)</label>
                            <select class="form-control" data-live-search="true" id="idiomaEntrada" name="idiomaEntrada"
                                    title="1º) Idioma de Entrada">
                                @foreach($idiomas as $key=>$value)
                                    @if(old('idiomaEntrada'))
                                        {{ $idiomaEntrada = old('idiomaEntrada') }}
                                    @else
                                        {{ $idiomaEntrada = null }}
                                    @endif
                                    <option data-tokens="ketchup mustard" data-toggle="{{$value->imagem}}"
                                            value="{{ $value->id }}" {{ $idiomaEntrada == $value->id ? 'selected' : ''}}> {{ $value->nome }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                <strong class="text-warning" id="idiomaEntradaLink"></strong>
                            </span>                            
                        </div>

                        <div class="col-md-5">
                            <label for="texto" class="control-label">2º) Frases <br>(write a letter and then another letter)</label>
                            <div class="position-relative-tradutor has-feedback">
                                <input type="text" class="form-control " id="texto" name="texto" title="2º) Frases">
                                <span class="form-clear-tradutor hide"><strong
                                            class="material-icons-tradutor" title="Limpar campo texto">x</strong></span>
                            </div>
                            <input type="hidden" name="codigo_pesquisado" id="codigo_pesquisado" value="">
                            <div id="listaTexto"></div>
                        </div>

                        <div class="col-md-3">
                            <input type="hidden" name="idiomas_retorno" id="idiomas_retorno" value="">
                            <label for="idiomaSaida" class="control-label">3º) Idioma de Saída <br>(choose the Language to be Translated)</label>
                            <select class="form-control" data-live-search="true" id="idiomaSaida"
                                    name="idiomaSaida" title="3º) Idioma de Saída">
                                <option value="" class="classidiomaSaida">Selecione</option>
                            </select>
                            <span class="help-block">
                                <strong class="text-warning" id="idiomaSaidaLink"></strong>
                            </span>
                        </div>

                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <input type="button" class="input-group btn btn-success" value="Traduzir" title="Traduzir"
                                   name="traduzir" id="traduzir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <label class="control-label">4º) Resultado</label>
                            <input type="hidden" name="resultado" id="resultado">
                            <div id="resultadoTraducao" class="text-left form-control"></div>
                            <br>
                            <div>
                                <input type="button" class="btn btn-success"
                                       style=""
                                       value="Enviar para o chat" title="Enviar para o chat" name="btnEnviarFraseChat"
                                       id="btnEnviarFraseChat">
                            </div>
                            <br>
                            <div class="alert alert-warning hide" id="mensagemAbaixoResultado">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong style="color: red;">Atenção!</strong> Para enviar para o chat é preciso entrar
                                no chat e selecionar o nickname desejado
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info control-label"> Clique no botão <strong>Enviar para o chat</strong>
                        quando os campos estiverem todos preenchidos e <strong>sempre selecione antes algum
                            usuário</strong> do chat para o qual a frase será enviada.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong class="control-label">5º) Chat - </strong>
                    <button type="button" class="btn-group-sm btn-success hide" name="btnChatSair" id="btnChatSair"
                            title="Clique aqui para sair do chat" value="Clique aqui para sair do chat">
                        Clique aqui para sair do chat
                    </button>
                </div>
                <div class="panel-body alert-info">
                    <div id="divMensagemErroEntrar" class="alert alert-danger hide">
                        <strong id="mensagemErroEntrar"></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="panel-body col-lg-12" id="chat_login">
                        <div class="row form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="nickname" class="control-label">Nickname</label>
                                    <input type="text" name="nickname" id="nickname" class="form-control"
                                           required="required" title="Nickname" placeholder="Nickname">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">&nbsp;</label>
                                    <input type="button" class="input-group btn btn-success " value="Entrar"
                                           name="chatEntrar" id="chatEntrar" title="Entrar">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 hide" id="chat_logout">
                        <div class="row">
                            <div class="form-group">
                                <input type="hidden"
                                       value="{{ session("chat_users") ? current(session("chat_users")) : '' }}"
                                       id="chat_users_session" name="chat_users_session">
                                <label class="control-label"
                                       id="nickname_chat_online">Nickname: {{ session("chat_users") ? current(session("chat_users")) : '' }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 hide" id="users_online">
                        <div class="row">
                            <div class="list-group" id="listGroupUsuarios"></div>
                        </div>
                    </div>

                    <div class="col-lg-8 hide" id="messages_online">
                        <div class="row form-group">
                            <div class="col-md-10">
                                <div class=""><strong>Mensagem</strong></div>
                                <nav>
                                    <ul id="userRecebeMensagem"
                                        style="height:200px; width:100%; overflow:hidden; overflow-y:scroll;"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong class="control-label">6º) Enviar frase por e-mail
                        (A frase escolhida e traduzida no 4º) Resultado está pronta para o envio)</strong>
                </div>
                <div class="panel-body alert-info">
                    <div class="alert hide" id="mensagemEnvioFrase"></div>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="desRemetente" class="control-label">Remetente</label>
                            <input type="text" class="form-control" name="desRemetente" id="desRemetente"
                                   placeholder="Remetente" title="Remetente">
                        </div>
                        <div class="col-md-5">
                            <label for="desEmail" class="control-label">E-mail</label>
                            <input type="text" class="form-control" name="desEmail" id="desEmail" placeholder="E-mail"
                                   title="E-mail">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-info" id="enviarEmail" name="enviarEmail"
                                    title="Enviar e-mail">
                                Enviar e-mail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('rodape')

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/translate.min.js')}}"></script>
<script src="{{asset('js/default.js')}}"></script>
<script>

    var conversaUsuario = function (idNicknameEscolhido) {
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('principal.enviamensagemchat') }}",
            method: "POST",
            data: {idNicknameEscolhido: idNicknameEscolhido, _token: _token},
            success: function (data) {
                $('#userRecebeMensagem').html(data);
            }
        });
    };

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && $('#nickname').val() && !$('#chat_users_session').val()) {
            $('#chatEntrar').click();
        }
    });

    function setTime() {
        if ($('#chat_users_session').val()) {
            setTimeout(setTime, 3000);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('principal.verificarusuarioonline') }}",
                method: "POST",
                data: {_token: _token},
                success: function (data) {
                    $('#listGroupUsuarios').html(data);
                }
            });
            if ($('#idNicknameEscolhido').val()) {
                conversaUsuario($('#idNicknameEscolhido').val());
            }
        }
    }

    function idiomaEntradaLink(idioma){
        var _token = $('input[name="_token"]').val();
        //$('#texto').focus();
        $.ajax({
                url: "{{ route('principal.idiomalink') }}",
                method: "POST",
                data: {
                    idioma: idioma,
                    _token: _token
                },
                success: function (data) {
                    if(data.link != null){
                        $('#idiomaEntradaLink').html('<a href="'+data.link+'" target="_blank" >Wikipédia idioma</a>');    
                    }
                    else{
                        $('#idiomaEntradaLink').html('');
                    }                  
                }
            });        
    }

    function idiomaSaidaLink(idioma){
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url: "{{ route('principal.idiomalink') }}",
                method: "POST",
                data: {
                    idioma: idioma,
                    _token: _token
                },
                success: function (data) {
                    if(data.link != null){
                        $('#idiomaSaidaLink').html('<a href="'+data.link+'" target="_blank" >Wikipédia idioma</a>');
                    }
                    else{
                        $('#idiomaSaidaLink').html('');
                    }
                }
            });        
    }

    $(document).ready(function () {
        $('#idiomaEntrada').focus();
        $("#idiomaEntrada").select2({
            templateResult: format,
            templateSelection: formatState,
            escapeMarkup: function (m) {
                if($('#idiomaEntrada').val()){
                    idiomaEntradaLink($('#idiomaEntrada').val());                    
                }                
                return m;
            }
        });


        $("#idiomaSaida").select2({
            templateResult: format,
            templateSelection: formatState,
            escapeMarkup: function (m) {
                if($('#idiomaSaida').val()){
                    idiomaSaidaLink($('#idiomaSaida').val());    
                }
                
                return m;
            }
        });

        setTime();
        if ($('#chat_users_session').val()) {
            $('#users_online').removeClass('hide');
            $('#messages_online').removeClass('hide');
            $('#chat_logout').removeClass('hide');
            $('#chat_login').addClass('hide');
            $('#btnChatSair').removeClass('hide');
        }
        
        $('#btnEnviarFraseChat').on('click', function () {
            var idNicknameEscolhido = $('#idNicknameEscolhido').val();
            var chat_users_session = $('#chat_users_session').val();
            var resultado = $('#resultadoTraducao').html();
            var _token = $('input[name="_token"]').val();
            if (idNicknameEscolhido > 0) {
                $.ajax({
                    url: "{{ route('principal.gravarmensagemchat') }}",
                    method: "POST",
                    data: {
                        idNicknameEscolhido: idNicknameEscolhido,
                        chat_users_session: chat_users_session,
                        resultado: resultado,
                        _token: _token
                    },
                    success: function (data) {
                        conversaUsuario(idNicknameEscolhido);
                    }
                });
            } else {
                $('#mensagemAbaixoResultado').removeClass('hide');
            }
        });

        $('#chatEntrar').on('click', function () {
            var nickname = $('#nickname').val();
            var _token = $('input[name="_token"]').val();
            if (nickname.length > 1) {
                $.ajax({
                    url: "{{ route('principal.entrarchat') }}",
                    method: "POST",
                    data: {nickname: nickname, _token: _token},
                    success: function (data) {
                        if (data.nickname) {
                            $('#users_online').removeClass('hide');
                            $('#messages_online').removeClass('hide');
                            $('#chat_logout').removeClass('hide');
                            $('#btnChatSair').removeClass('hide');
                            $('#chat_login').addClass('hide');
                            $('#nickname_chat_online').html('Nickname: ' + data.nickname);
                            $('#chat_users_session').val(data.nickname);
                        } else if (data.erro) {
                            $('#divMensagemErroEntrar').removeClass('hide');
                            $('#mensagemErroEntrar').removeClass('hide').html(data.erro);
                            $('#btnChatSair').addClass('hide');
                        } else {
                            $('#users_online').addClass('hide');
                            $('#messages_online').addClass('hide');
                            $('#chat_logout').addClass('hide');
                            $('#btnChatSair').addClass('hide');
                            $('#chat_login').removeClass('hide');
                            $('#nickname_chat_online').html('');
                        }
                        setTime();
                    }
                });
            } else {
                $('#divMensagemErroEntrar').removeClass('hide');
                $('#mensagemErroEntrar').html('Informe o campo Nickname');
                $('#nickname').focus();
            }
        });

        $('#btnChatSair').on('click', function () {
            var chat_users_session = $('#chat_users_session').val();
            var _token = $('input[name="_token"]').val();
            if (chat_users_session.length > 1) {
                $.ajax({
                    url: "{{ route('principal.sairchat') }}",
                    method: "POST",
                    data: {chat_users_session: chat_users_session, _token: _token},
                    success: function (data) {
                        $('#userRecebeMensagem').html('');
                        location.reload();
                    }
                });
            }
        });

        $('#btnEnviarMensagem').on('click', function () {
            var chat_users_session = $('#chat_users_session').val();
            var mensagemChat = $('#mensagemChat').val();
            var _token = $('input[name="_token"]').val();
            if (chat_users_session.length > 5) {
                $.ajax({
                    url: "{{ route('principal.enviamensagemchat') }}",
                    method: "POST",
                    data: {chat_users_session: chat_users_session, mensagemChat: mensagemChat, _token: _token},
                    success: function (data) {

                    }
                });
            }
        });

        pegaValor = function (obj) {
            $('#texto').val($(obj).text()).change();
            $('#codigo_pesquisado').val($(obj).attr('value'));
            $('#listaTexto').fadeOut();
            $('#idiomaSaida').focus();
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.position-relative-tradutor :input').on('keydown focus', function () {
            if ($(this).val().length > 0) {
                $('.form-clear-tradutor').removeClass('hide');
            }
        }).on('keydown keyup blur', function () {
            if ($(this).val().length === 0) {
                $('.form-clear-tradutor').addClass('hide');
            }
        });
        $('.form-clear-tradutor').on('click', function () {
            //$(this).addClass('hide').prevAll(':input').val('');
            //location.reload();
            $('#codigo_pesquisado').val('');
            $('#idiomaSaida').val('').html('<option value="">Selecione</option>');
            $('#resultado').val('');
            $('#resultadoTraducao').html('');
            $('#texto').val('');
        });

        $('#idiomaEntrada').change(function () {
            //$('#texto').removeAttr('disabled', true);
        });

        $('#texto').on('keyup', function () {
            var idiomaEntrada = $('#idiomaEntrada').val();
            var texto = $('#texto').val();
            var _token = $('input[name="_token"]').val();
            if (texto.length >= 1 && idiomaEntrada > 0) {
                $.ajax({
                    url: "{{ route('principal.fetch') }}",
                    method: "POST",
                    data: {idiomaEntrada: idiomaEntrada, texto: texto, _token: _token},
                    success: function (data) {
                        $('#listaTexto').html(data).fadeIn();
                    }
                });
            }
        });

        $('#texto').on('change', function () {
            setTimeout(function () {
                var codigo_pesquisado = $('#codigo_pesquisado').val();
                var idiomaEntrada = $('#idiomaEntrada').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('principal.idiomapesquisado') }}",
                    method: "POST",
                    data: {codigo: codigo_pesquisado, idiomaEntrada: idiomaEntrada, _token: _token},
                    success: function (data) {
                        if ($('#idiomas_retorno').val() != data) {
                            $('#idiomas_retorno').val(data);
                            $.each(data, function (key, val) {
                                //$('#idiomaSaida').append(new Option(val.nome, val.id));
                                $('#idiomaSaida').append("<option value='"+val.id+"' data-toggle='"+val.imagem+"'>"+val.nome+"</option>");
                            });
                        }
                    }
                });
            }, 1000);
        });

        $('#idiomaSaida').change(function () {
            if ($(this).val()) {
                $('#traduzir').removeClass('hide');
            } else {
                $('#traduzir').addClass('hide');
            }
        });

        $('#traduzir').click(function () {
            var texto = $('#texto').val();
            var idiomaSaida = $('#idiomaSaida').val();
            var _token = $('input[name="_token"]').val();
            var link = '';
            var linkReal = '';
            var string = '';
            $.ajax({
                url: "{{ route('principal.idiomatraduzir') }}",
                method: "POST",
                data: {texto: texto, idiomaSaida: idiomaSaida, _token: _token},
                success: function (data) {
                    string = $('#texto').val();
                    if (string.match(/https/)) {
                        link = $('#texto').val().split("https");
                        linkReal = 'https' + link[1];
                        link = "<a href='https" + link[1] + "' target='_blank'>" + linkReal + "</a>";
                    }
                    $('#resultado').val(data.texto);
                    $('#resultadoTraducao').html(data.texto + " " + link);
                }
            });
        });

        $('#enviarEmail').click(function () {
            var texto = $('#texto').val();
            var idiomaSaidaTexto = $("#idiomaSaida option:selected").text();
            var idiomaEntradaTexto = $("#idiomaEntrada option:selected").text();
            var resultado = $('#resultadoTraducao').html();
            //var chat_users_session = $('#chat_users_session').val();
            var desRemetente = $('#desRemetente').val();
            var desEmail = $('#desEmail').val();

            if (!texto || !idiomaSaidaTexto || !idiomaEntradaTexto || !resultado || !desRemetente || !desEmail) {
                $('#mensagemEnvioFrase').removeClass('hide').addClass('alert-danger').html('Favor verifique se os campos: <br/>1º) Idioma Entrada <br/>2º) Frases <br/>3º) Idioma Saída <br/>4º) Resultado  <br/>Remetente<br/> e E-mail<br/> foram preenchidos.' + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button>");
            }

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('principal.enviarfraseemail') }}",
                method: "POST",
                data: {
                    texto: texto,
                    idiomaSaidaTexto: idiomaSaidaTexto,
                    idiomaEntradaTexto: idiomaEntradaTexto,
                    resultado: resultado,
                    desRemetente: desRemetente,
                    desEmail: desEmail,
                    _token: _token
                },
                success: function (data) {
                    if (data.result == 'success') {
                        $('#mensagemEnvioFrase').removeClass('hide').addClass('alert-success').html(data.title + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button>");
                    } else if (data.result == 'error') {
                        $('#mensagemEnvioFrase').removeClass('hide').addClass('alert-danger').html(data.title + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button>");
                    } else {
                        $('#mensagemEnvioFrase').addClass('hide').html('');
                    }
                },
                error: function (data) {
                    if (data.result == 'error') {
                        $('#mensagemEnvioFrase').removeClass('hide').addClass('alert-danger').html(data.title + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button>");
                    } else {
                        $('#mensagemEnvioFrase').addClass('hide').html('');
                    }
                }
            });
        });


    });

</script>
</body>
</html>
