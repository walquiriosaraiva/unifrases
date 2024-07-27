@section('titulo','Página de instruções Unifrases')
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
                <div class="panel-heading" style="padding: 5px 15px !important;"><h4><strong>Instrução</strong></h4></div>
                <div class="panel-body">
                    <div class="panel-group">
                        <p class="text-left"><strong>INSTRUÇÃO.</strong></p>
                        <p class="text-justify">
                            <strong>Atenção!</strong> Ative em <strong>"Configurações"</strong> em <strong>"Acessibilidade"</strong>, para ouvir o que está escrito na tela do seu <strong>"Smartphone"</strong>, inclusive a frase traduzida.<br/>
                            <strong>Attention!</strong> In <strong>"Settings"</strong>, activate the <strong>"Accessibility"</strong> mode, to hear what is written on the screen of your <strong>"Smartphone"</strong>, including the translated phrase.<br/>
                            <strong>¡Atención!</strong> En <strong>"Configuración"</strong>, activa el modo <strong>"Accesibilidad"</strong>, para escuchar lo que está escrito en la pantalla de tu <strong>"Smartphone"</strong>, incluida la frase traducida.<br/>
                            <strong>Внимание!</strong> В <strong>"Настройках"</strong> активируйте режим <strong>"Доступность"</strong>, чтобы слышать, что написано на экране вашего <strong>"Смартфона"</strong>, включая переведенную фразу.
                        </p>
                        <p class="text-justify">
                            <strong>ATENÇÃO:</strong> Pedimos desculpas pelas traduções que apresentem falhas. Estamos
                            trabalhando muito para melhorar estes resultados.<br/>

                            <strong>Sugestão:</strong> Conheça mais sobre o seu País! Escreva: Eu sou do (nome do
                            País...).<br/>
                            <strong>Suggestion:</strong> Know more about your Country! Write: I am from (name of the
                            Country...).<br/>
                            <strong>Consejo:</strong> ¡Conoce más sobre tu País! Escribir: Soy de (nombre del país ...).<br/>
                            <strong>Совет:</strong> узнай больше о своей Cтране! Напишите: (название страны ...).<br/>
                        </p>
                        <p class="text-justify">
                            <strong>INSTRUÇÕES: Escolha o 1º) Idioma de Entrada e logo em seguida, comece a 2º) Frase
                                com uma letra e depois outra letra, que as frases vão aparecendo (Auto-Complete)
                                conforme as que estão cadastradas no sistema, depois você escolhe uma e em seguida o 3º)
                                Idioma de Saída, então é só Clicar em (Traduzir), que o 4º) Resultado aparece e é só
                                escrever o E-mail do destinatário embaixo, que o sistema envia a Frase
                                traduzida.</strong>
                        </p>
                        <p class="text-justify">
                            No uso do "Chat", você pode usar o famoso "Ctrl C" e "Ctrl V", que já dá para "conversar"
                            com outro idioma, mesmo que você desconheça esse idioma. Ou seja, "Copiar e Colar" é fácil e
                            já esta à disposição. Nós estamos trabalhando muito para "automatizar" o tradutor, e quando
                            conseguirmos concluir esta etapa, esse problema da diferença do idioma, assim estará
                            superado.
                        </p>

                        <p class="text-left"><strong>INSTRUCTION.</strong></p>
                        <p class="text-justify">
                            <strong>PLEASE NOTE:</strong> We apologize for the translations that are faulty. We are
                            working hard to improve these results.
                        </p>
                        <p class="text-justify">
                            <strong>INSTRUCTIONS: Choose the 1º) Input Language and then immediately start the 2º)
                                Phrase with a letter and then another letter, that the phrases will appear
                                (Auto-Complete) as they are registered in the system, then you choose one and then the
                                3º) Output Language, then just click on (Translate), the 4º) Result appears and just
                                write the recipient's E-mail below, and the system sends the translated
                                Sentence.</strong>
                        </p>
                        <p class="text-justify">
                            When using the "Chat", you can use the famous "Ctrl C" and "Ctrl V", which already gives to
                            "talk" to another language, even if you were unaware that language. That is, "Copy and
                            Paste" is easy and already available. We are working hard to "automate" the translator, and
                            when we can complete this step, the problem of language difference, so shall overcome.
                        </p>

                        <p class="text-left"><strong>INSTRUCCIÓN.</strong></p>
                        <p class="text-justify">
                            <strong>NOTA:</strong> Nosotros disculpas por las traducciones que son defectuosos. Estamos
                            trabajando duro para mejorar estos resultados.
                        </p>
                        <p class="text-justify">
                            <strong>INSTRUCCIONES: Elija el 1º) Idioma de entrada e inmediatamente comience la 2º) Frase
                                con una letra y luego otra letra, para que las frases aparezcan (Autocompletar) a medida
                                que se registran en el sistema, luego elija una luego el 3º) Idioma de salida, luego
                                haga clic en (Traducir), aparece el 4º) Resultado y simplemente escriba el correo
                                electrónico del destinatario a continuación, y el sistema envía la Oración
                                traducida.</strong>
                        </p>

                        <p class="text-left"><strong>Инструкция.</strong></p>
                        <p class="text-justify">
                            <strong>ОБРАТИТЕ ВНИМАНИЕ:</strong> Мы извиняемся за переводы, которые неисправны. Мы
                            прилагаем все усилия, чтобы улучшить эти результаты.
                        </p>
                        <p class="text-justify">
                            <strong>ИНСТРУКЦИИ: Выберите 1º) язык ввода, а затем сразу же начните 2º) Фраза с буквой, а
                                затем еще одна буква, что фразы появятся (автозаполнение), как они зарегистрированы в
                                системе, затем вы выбираете один и затем 3º) Язык вывода, затем просто нажмите
                                (Перевести), 4º) Результат появится и просто напишите электронное письмо получателя
                                ниже, и система отправит переведенное предложение.
                            </strong>
                        </p>
                        <p class="text-justify">
                            При использовании "Чат", вы можете использовать известную "Ctrl C" и "Ctrl V", который уже
                            дает "разговаривать" на другой язык, даже если вы не знали, что язык. То есть, "Копирование
                            и вставка" легко и уже доступны. Мы прилагаем все усилия, чтобы "автоматизировать"
                            переводчик, и когда мы можем завершить этот шаг, проблема разницы языка, так и должно
                            преодолеть.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('rodape')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/default.js')}}"></script>
</div>
</body>
</html>