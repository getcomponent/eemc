<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ЭУМК</title>
    <link href="../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../../css/modern-business.css" rel="stylesheet">
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/main.js?{{rand()}}"></script>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">МРК</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/theory">Теоретический раздел</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/practice">Практический раздел</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tests">Раздел контроля знаний</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/supporting">Вспомогательный раздел</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('login'))
                        <div class="nav-link">
                            @auth
                            @if($user->status == 'admin')
                            <a href="{{ url('/admin') }}">Администрирование</a>
                            @endif
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a href="{{ route('login') }}">Войти</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">Зарегистрироваться</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Минск 2019</p>
        </div>
    </footer>
</body>

</html>
