<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- FONTAWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="//db.onlinewebfonts.com/c/dd97c93d1184d223b93c9042b7e57980?family=Stratos+Web" rel="stylesheet" type="text/css"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Chartjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>


    {{-- VUE --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    {{-- AXIOS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-dashboard d-flex flex-column vh-100">
        <div class="button-ham">
            <button class="ham">
                <span class="menuIcon">
                    <i class="fas fa-bars"></i>
                </span>
                <span class="xIcon">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </div>
        <div class="dropdown">
            <ul class="drop-menu">
                <li><a class="menuLink" href="{{route('admin.index')}}">Dashboard</a></li>
                <li><a class="menuLink" href="{{route('admin.dishes.index')}}">Piatti</a></li>
                <li><a class="menuLink" href="{{route('admin.orders.index')}}">Ordini</a></li>
                <li><a class="menuLink" href="{{route('admin.statistics.index')}}">Statistiche</a></li>
            </ul>
        </div>
        <div class="container-fluid h-100">
            <div class="row h-100">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4 border-right position-fixed vh-100">
                    <div class="sidebar-nav">
                        <div class="dashboard-logo">
                            <a href="{{ route('uiHome') }}">
                                <img src="https://logodownload.org/wp-content/uploads/2019/09/deliveroo-logo-2.png" alt="logo deliveroo">
                            </a>
                        </div>
                        <div class="sidebar-nav link">
                            <div class="sidebar-sticky">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('admin.index')}}">
                                            <i class="fas fa-house-user"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="only-icon">
                                        <a class="only-icon" href="{{route('admin.index')}}">
                                            <i class="fas fa-house-user"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('admin.dishes.index')}}">
                                                <i class="fas fa-utensils"></i>
                                            Piatti
                                        </a>
                                    </li>
                                    <li class="only-icon">
                                        <a class="only-icon" href="{{route('admin.dishes.index')}}">
                                            <i class="fas fa-utensils"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('admin.orders.index')}}">
                                                <i class="fab fa-elementor"></i>
                                            Ordini
                                        </a>
                                    </li>
                                    <li class="only-icon">
                                        <a class="only-icon" href="{{route('admin.orders.index')}}">
                                            <i class="fab fa-elementor"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route("admin.statistics.index")}}">
                                          <i class="fas fa-chart-bar"></i>
                                          Statistiche
                                        </a>
                                    </li>
                                    <li class="only-icon">
                                        <a class="only-icon" href="{{ route("admin.statistics.index")}}">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar-logout">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link logout uppercase" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4 py-4 background-container">
                    @yield('admin.content')
                </main>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    var menu = document.querySelector(".drop-menu")
    var ham = document.querySelector(".ham")
    var xIcon = document.querySelector(".xIcon")
    var menuIcon = document.querySelector(".menuIcon")

    ham.addEventListener("click", toggleMenu)

    function toggleMenu() {
        if (menu.classList.contains("showMenu")) {
            menu.classList.remove("showMenu");
            xIcon.style.display = "none";
            menuIcon.style.display = "block";
        } else {
            menu.classList.add("showMenu");
            xIcon.style.display = "block";
            menuIcon.style.display = "none";
        }
    }

    var menuLinks = document.querySelectorAll(".menuLink")

    menuLinks.forEach(
        function (menuLink) {
            menuLink.addEventListener("click", toggleMenu)
        }
    )
    </script>
</body>
</html>
