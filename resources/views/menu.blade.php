<header class="row container-fluid">
    <nav class="navbar navbar-inversed nav-justified well-sm ">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/img/logo-unifrases.gif" class="img-responsive-mod" alt="logo-unifrases">
                </a>
                <a href='/' class="qrcode">
                    <h5><img src="/img/qrcode.png" style="" class="img-responsive-mod" alt="qrcode"></h5>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" >
                <ul class="nav navbar-nav navbar-left">
                    <li><a href='/'><h5><img src="/img/qrcode.png" class="img-responsive-mod qrcode-app" alt="qrcode"></h5></a></li>                    
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ route('principal.apresentacao') }}"><h5>Apresentação</h5></a></li>
                    <li><a href="{{ route('principal.biblioteca') }}"><h5>Biblioteca</h5></a></li>
                    <li><a href="{{ route('principal.contato') }}"><h5>Contato</h5></a></li>
                    <li><a href="{{ route('principal.instrucao') }}"><h5>Instruções</h5></a></li>
                    <li><a href="{{ route('principal.libratos') }}"><h5>Libratos</h5></a></li>
                    <li><a href="{{ route('principal.libror') }}"><h5>Libror</h5></a></li>
                    <li><a href="{{ route('principal.links') }}"><h5>Links</h5></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ route('principal.links') }}" title="Sistema acessível utilizando o leitor de telas NVDA"><h4 class="alert-warning">Sistema acessível utilizando o leitor de telas NVDA</h4></a></li>
                    <li><a href="/" title="Local e Data"><h5>Brasilia - Distrito Federal - Brasil </h5> <h5 class="text-center" id="dataHoraServidor"></h5></a></li>  
                </ul>
            </div>
        </div>
    </nav>
    {{ csrf_field() }}
</header>