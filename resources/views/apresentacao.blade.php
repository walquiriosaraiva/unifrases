@section('titulo','Página de apresentação Unifrases')
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
                <div class="panel-heading" style="padding: 5px 15px !important;"><h4><strong>Apresentação</strong></h4></div>
                <div class="panel-body">
                    <div class="panel-group">
                        <p class="text-left"><strong>O QUE É O UNIFRASES?</strong></p>
                        <p class="text-justify">
                            Diferente de um dicionário tradutor de palavras, o UniFrases é um Comutador Universal de
                            Frases. Cada Frase e suas respectivas traduções para as demais línguas são cadastradas no
                            sistema previamente, de forma que o significado destas frases é o mais aproximado possível
                            das suas traduções, que não são feitas palavra-a-palavra, como outros tradutores do mercado.
                        </p>
                        <p class="text-justify">
                            Além de ter a tradução das frases, o UniFrases atribui um serviço especial de envio de
                            e-mail, com a frase traduzida, ou seja, você escolhe a frase no seu idioma e seleciona o
                            idioma a ser comutado e envia a frase já comutada e traduzida, o procedimento inverso
                            acontece para o seu interlocutor também, assim trazendo eficácia nos diálogos dos usuários
                            do nosso sistema, bem como abrindo novas possibilidades de aplicações na comunicação,
                            inclusive de pessoas portadoras de necessidades especiais.
                        </p>

                        <p class="text-justify">
                            <strong>IMPORTANTE:</strong> Sabemos que existem falhas e incorreções nas traduções, pelo
                            que pedimos sinceras desculpas, entretanto, estamos trabalhando muito forte, para melhorar
                            cada vez mais os resultados oferecidos, aos nossos usuários.
                        </p>

                        <p class="text-justify">
                            Esse sistema será automatizado tão logo quanto possível!
                        </p>

                        <p class="text-justify">
                            <strong>O QUE SÃO FRASES PARA O UNIFRASES?</strong>
                        </p>

                        <p class="text-justify">
                            Frases são combinações de palavras de um determinado idioma que obedecem as regras
                            gramaticais deste idioma e constroem um significado específico.
                        </p>

                        <p class="text-justify">
                            Muitas frases não fazem sentido dentro de um determinado contexto. E por isso o 'UniFrases'
                            está aberto para receber o 'vocabulário básico' de diversas áreas, mas o seu objetivo
                            principal será codificar o vocabulário básico mais comum e o mais amplamente utilizado, de
                            forma a se apresentar como uma ferramenta universal de grande utilidade pratica.
                        </p>

                        <p class="text-justify">
                            Neste sentido, o UniFrases oferece um serviço publico de comutação de milhares de frases
                            mais utilizadas.
                        </p>

                        <p class="text-justify">
                            Por motivos comerciais, até que o UniFrases tenha condições de investir no seu crescimento,
                            para um vocabulário mais amplo, atualmente mais de 60.000 frases já estão sendo
                            disponibilizadas para assinantes (Cadastrados), e aproximadamente 600 frases para
                            não-assinantes, do nosso conteúdo.
                        </p>

                        <p class="text-justify">
                            O UniFrases pode ser usado corporativamente também, incorporando em seu vocabulário termos
                            abertos ao publico deste uso corporativo, que pode ter também termos restritos a sua
                            comunidade.
                        </p>

                        <p class="text-justify">
                            Exemplo, para o Corpo de Bombeiros; Podem ser introduzidos no UniFrases termos que interessa
                            ao trabalho no atendimento de emergência, incêndio e resgates próprios à atividade, que
                            estejam disponíveis em outras línguas pelo Unifrases. Exemplo: Qual seu tipo de sangue? Você
                            é alérgico a algum medicamento? Fique calma, você será levada para um Hospital, etc.
                        </p>

                        <p class="text-justify">Outros termos são de conhecimento e uso apenas dos bombeiros, em suas
                            operações.</p>

                        <p class="text-justify">
                            Ex: Situação de embriagado violento que ainda não foi contido, incêndio não controlado com
                            vidas em risco, acidente automobilí­stico com vitima fatal, etc.
                        </p>

                        <p class="text-justify">
                            Estes termos, identificados por um código, como é a proposta do UniFrases, criam novas
                            possibilidades de comunicação e acessibilidade.
                        </p>

                        <p class="text-justify">
                            <strong>CRESCIMENTO DA BASE.</strong>
                        </p>

                        <p class="text-justify">
                            O sistema hoje contém mais de 60.000 frases cadastradas e traduzidas, e este número irá
                            crescer rapidamente com o lançamento do sistema para o público, pois cada frase digitada que
                            não está cadastrada no sistema, assim irá entrar em uma lista ordenada pela frequência, em
                            que esta frase é procurada, e elas serão submetidas à tradução e serão incluí­das no
                            sistema.
                        </p>

                        <p class="text-justify">
                            <strong>MODELO DE NEGÓCIO: (POR ENQUANTO É GRÁTIS).</strong>
                        </p>

                        <p class="text-justify">
                            O UniFrases manterá um acervo com centenas de frases de uso comum de acesso gratuito.
                        </p>

                        <p class="text-justify">Porém sua base integral de milhares de frases só poderá ser acessada por
                            assinantes que comprarem o acesso anual à ferramenta.</p>

                        <p class="text-justify">
                            Além das frases de acesso livre e do acervo geral, o UniFrases poderá conter vocabulários
                            específicos de públicos privados e corporações. Estas serão de acesso apenas aos usuários
                            destes grupos, que também poderão acessar o restante do acervo geral do UniFrases.
                        </p>

                        <p class="text-justify">
                            <strong>ORGANIZAÇÃO DA BASE.</strong>
                        </p>

                        <p class="text-justify">
                            O 'vocabulário de frases do Unifrases parte de frases mais utilizadas no cotidiano das
                            pessoas, universalmente falando. Porém, rapidamente as palavras começam a ter significados
                            particulares em seus idiomas de origem, de forma que, se por um lado passa a ser importante
                            a revisão das traduções por nativos das regiões, e por outro existam contextos específicos,
                            seja de corporações, seja de grupos de pessoas e culturas diferentes.
                        </p>

                        <p class="text-justify">
                            Por isso além das frases, o UniFrases tem um cadastro de 'assuntos', e as frases são
                            classificadas como de acesso universal ou restritas a membros de determinados grupos e
                            usuários do 'Unifrases'.
                        </p>

                        <p class="text-justify">
                            <strong>POLÍTICAS DE USO E PRIVACIDADE.</strong>
                        </p>

                        <p class="text-justify">
                            O UniFrases manterá em seu acervo geral apenas frases de uso universal e aceitas em um nível
                            coloquial e formal, não fazendo parte deste público palavrões ou frases de baixo calão.
                            Estes termos podem ser usados em contextos privados do sistema, cujo acesso será restrito
                            aos usuários autorizados.
                        </p>

                        <p class="text-justify">
                            <strong>CERTIDÃO DE REGISTRO OU AVERBAÇÃO AUTORAL.</strong>
                        </p>

                        <p class="text-justify">
                            <a href="download/Certidao.pdf" target="_blank" title="Download da Certidão">Download da
                                Certidão</a>
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