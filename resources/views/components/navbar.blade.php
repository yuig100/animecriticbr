<div class="center">
    <div class="logo">
        <a href="/">
            <img src="{{asset('/logo_animecriticbr_teste.png')}}" />
        </a>
    </div>

    <div class="menu-desktop">
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
            <li class="nav-item dropdown dropdown-hover">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/noticias">Notícias</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    <a class="dropdown-item" href="/searchcat?query=Manga">Manga</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking de Venda">Ranking de Venda</a>
                    <a class="dropdown-item" href="/searchcat?query=Compras">Compras</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking Japonês">Ranking Japonês</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking BR">Ranking BR</a>
                </div>
            </li>
            <li>
                <a href="/analises">Análises</a>
            </li>
            <li>
                <a href="/animes">Animes</a>
            </li>
            <li class="nav-item dropdown dropdown-hover">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/calendario">Calendário</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    @if(date('m') >= 1 && date('m') <= 3)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/inverno">Calendário Atual</a>
                    @elseif(date('m') >= 4 && date('m') <= 6)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/primavera">Calendário Atual</a>
                    @elseif(date('m') >= 7 && date('m') <= 9)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/verao">Calendário Atual</a>
                    @elseif(date('m') >= 10 && date('m') <= 12)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/outono">Calendário Atual</a>
                    @endif
                </div>
            </li>
            <li>
                <a href="/guia-de-temporada">Guia de Temporada</a>
            </li>
            <li>
                <a href="/contato">Contato</a>
            </li>
        </ul>
    </div>

    <div class="menu-mobile">
        <a class="icon-menu">
            <i class="fa-solid fa-bars"></i>
        </a>
        <ul>
            <hr />
            <li>
                <a href="/">Home</a>
            </li>
            <hr />
            <li class="nav-item dropdown dropdown-hover">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/noticias">Notícias</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    <a class="dropdown-item" href="/searchcat?query=Manga">Manga</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking de Venda">Ranking de Venda</a>
                    <a class="dropdown-item" href="/searchcat?query=Compras">Compras</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking Japonês">Ranking Japonês</a>
                    <a class="dropdown-item" href="/searchcat?query=Ranking BR">Ranking BR</a>
                </div>
            </li>
            <hr />
            <li>
                <a href="/analises">Análises</a>
            </li>
            <hr />
            <li>
                <a href="/animes">Animes</a>
            </li>
            <hr />
            <li class="nav-item dropdown dropdown-hover">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/calendario">Calendário</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    @if(date('m') >= 1 && date('m') <= 3)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/inverno">Calendário Atual</a>
                    @elseif(date('m') >= 4 && date('m') <= 6)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/primavera">Calendário Atual</a>
                    @elseif(date('m') >= 7 && date('m') <= 9)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/verao">Calendário Atual</a>
                    @elseif(date('m') >= 10 && date('m') <= 12)
                    <a class="dropdown-item" href="/calendario/{{date('Y')}}/outono">Calendário Atual</a>
                    @endif
                </div>
            </li>
            <hr />
            <li>
                <a href="/guia-de-temporada">Guia de Temporada</a>
            </li>
            <hr />
            <li>
                <a href="/contato">Contato</a>
            </li>
            <hr />
            @if (Auth::check())
            <li class="nav-item dropdown dropdown-hover">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/profile/{{auth()->user()->nickname}}">{{auth()->user()->nickname}}</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    <a class="dropdown-item" href="/profile/edit/{{auth()->user()->nickname}}">Editar Perfil</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
            <hr />
            @else
            <li>
                <a href="/login">Login</a>
            </li>
            <hr />
            <li>
                <a href="/register">Registro</a>
            </li>
            <hr />
            @endif
        </ul>
    </div>

    <div class="menu-desktop">
        <ul>
            @if (Auth::check())
            <li class="dropdown dropdown-hover">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="/profile/{{auth()->user()->nickname}}">{{auth()->user()->nickname}}</a>
                <div id="dropdown-menu" class="dropdown-menu">
                    <a class="dropdown-item" href="/profile/edit/{{auth()->user()->nickname}}">Editar Perfil</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
            @else
            <li>
                <a href="/login">Login</a>
            </li>
            <li>
                <a href="/register">Registro</a>
            </li>
            @endif
        </ul>
    </div>
</div>
