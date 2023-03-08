<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}" />
        <title>@yield('title')</title>

        <!-- Fonts-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}" />

        <!-- Meu CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    </head>
    <body>
        <header>
             <x-navbar></x-navbar>
        </header>
<main>
    <div class="container">
        @yield('content')
    </div>
    <aside class="sidebar">
        <div class="sidebar-MAL">
            <a href="https://myanimelist.net/profile/nomad8" target="_blank">
                <img src="{{asset('img/itens/MAL White.png')}}" /> Minha Lista
            </a>
        </div>
        @php use App\View\Components\SearchBar;
        @endphp
        <x-search-bar placeholder="Pesquisar no site"></x-search-bar>

        <h2>Propagandas</h2>

        <div class="pix"><img src="{{asset('img/itens/pix.png')}}" /></div>
    </aside>
</main>
<footer class="d-flex justify-content-center">
    <p class="nomeautor">Criador por Pedro Henrique Massa - {{now()->year}}</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Link para o JavaScript do Bootstrap -->
<script>
    var menuBar = document.querySelector('.menu-mobile a.icon-menu');

    menuBar.addEventListener('click', (e)=>{

    e.preventDefault();
    let menuMobile = document.querySelector('.menu-mobile ul');
    if (menuMobile.classList.contains('show-menu')) {
        menuMobile.classList.remove('show-menu');
    } else {
        menuMobile.classList.add('show-menu');
    }

});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="{{asset('js/script.js')}}"></script>
@yield('script')
</body>
</html>
