<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div id="loading" class="">

        </div>
    </div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-color-primary p-5">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <div class="logo">
                        <img class="logo-header"src="{{'../img/logo-bianco.jpg'}}" alt="">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link white-n" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link white-n" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        Dashboard
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
<div class="wrap">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="titleHeader">
                        <h1>I piatti che ami, a domicilio.</h1>
                    </div>
                    <div class="div-search d-flex align-items-center">
                            <span>Entra e scegli il tuo ristorante</span>
                            <a class="capitalize btn btn-primary button" href="{{ route('guest.restaurants') }}">
                                entra
                            </a>
                    </div>
                </div>
                <div class="col-md-1 col-xs-12">
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="image-header">
                        <img src="{{'../img/campaignrit.png'}}" alt="">
                        <div class="riquadro-blu-header">
                            <div class="riquadro-blu-header-inside">
                                <h1>#aCasaTuaConDeliveroo</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- fine_header --}}

<section class="jumbo-first">
    <div class="container">
        <h1>La selezione di Deliveroo</h1>
        <div class="row justify-content-between">
            <div class="col-md-5 col-xs-12">
                <div class="menu-image-small">
                    <a href="#">
                        <img class="img-small" src="{{'../img/confort.jpg'}}" alt="">
                            <p>I grandi classici che scaldano il cuore, perfetti in ogni momento.</p>
                        <a href="#">Scopri Comfort food</a>
                        <div class="centered">
                                <h2>Comfort food</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="menu-image-large">
                    <a href="#">
                        <img class="img-large"src="{{'../img/dolci_e_dessert.jpg'}}" alt="">
                            <p>Dolci piaceri per rendere la giornata ancora più gustosa</p>
                            <a href="#">Scopri Dolci e Dessert</a>
                        <div class="centered">
                            <h2>Dolci e dessert</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-7 col-xs-12">
                <div class="menu-image-large">
                    <a href="#">
                        <img class="img-large" src="{{'../img/condividere.jpg'}}" alt="">
                            <p>Serve una scusa per stare insieme? Ordina dai ristoranti che trasformeranno la tua serata in una vera festa.</p>
                        <a href="#">Scopri Perfetti da condividere</a>
                    <div class="centered">
                        <h2>Perfetti da condividere</h2>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="menu-image-small">
                    <a href="#">
                        <img class="img-small" src="{{'../img/esclusiva.jpg'}}" alt="">
                            <p>I più famosi, i più buoni, i preferiti. Quelli che trovi solo su Deliveroo.</p>
                        <a href="#">Scopri Esclusiva Deliveroo</a>
                    <div class="centered">
                        <h2>Esclusiva Deliveroo</h2>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cibi-preferiti">
    <div class="container">
        <h1>I tuoi piatti preferiti, consegnati da noi.</h1>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/croce.jpg'}}" alt="">
                        <h2>Deliveroo per Croce Rossa Italiana</h2>
                    <p>Deliveroo sta raccogliendo fondi per fornire cibo gratuito alle famiglie più in difficoltà, attraverso la Croce Rossa Italiana (CRI). Puoi contribuire alla raccolta fondi facendo una donazione qui.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/mac.jpg'}}" alt="">
                        <h2>McDonald's</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/obica.jpg'}}" alt="">
                        <h2>Obicà</h2>
                    <p>Ordina la tua mozzarella preferita a casa tua da Obicà grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/lievita.jpg'}}" alt="">
                        <h2>Lievità</h2>
                    <p>Ordina la tua pizza preferita a casa tua da Lievità grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/poke.jpg'}}" alt="">
                        <h2>Pokèria by NIMA</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/sushi.jpg'}}" alt="">
                        <h2>Daruma Sushi - Ponte Milvio e Centro</h2>
                    <p>Ordina il tuo sushi preferito a casa tua da Daruma Sushi grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/temakinho.jpg'}}" alt="">
                        <h2>Temakinho</h2>
                    <p>Ordina il tuo sushi preferito a casa tua da Temakinho grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/berbere.jpg'}}" alt="">
                        <h2>Berberè Pizzeria</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/rosticceria.jpg'}}" alt="">
                        <h2>Rosticceria Giacomo</h2>
                    <p></p>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/burger_king.jpg'}}" alt="">
                        <h2>Burger King</h2>
                    <p></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/macha.jpg'}}" alt="">
                        <h2>Macha</h2>
                    <p>Ordina i tuoi piatti preferiti della cucina giapponese a casa tua da Macha grazie alla consegna a domicilio di Deliveroo.</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="{{'../img/grom.jpg'}}" alt="">
                        <h2>Grom</h2>
                    <p>Tutti i prodotti sono senza glutine. Sono realizzati senza aggiunta di aromi, coloranti o emulsionanti e creati scegliendo solo il meglio della natura. Innamorati del nostro gelato e gusta anche i nostri biscotti, le creme spalmabili e il nostro cioccolato</p>
                </div>
            </div>
    </div>
</section>

<section class="cerca-tipo">
    <div class="container">
        <h1>Cerchi qualcos'altro?</h1>
            <span class="capitalize">halal</span>
            <span class="capitalize">colazione</span>
            <span class="capitalize">vegetariano</span>
            <span class="capitalize">messicano</span>
            <span class="capitalize">dessert</span>
            <span class="capitalize">indiano</span>
            <span class="capitalize">greco</span>
            <span class="capitalize">giapponese</span>
            <span class="capitalize">cinese</span>
            <span class="capitalize">libanese</span>
            <span class="capitalize">americano</span>
            <span class="capitalize">italiano</span>
            <span class="capitalize">thailandese</span>
            <span class="capitalize">sushi</span>
            <span class="capitalize">pizza</span>
    </div>
</section>
<section class="novita">
    <div class="container">
        <h1>Novità dalla nostra cucina</h1>
        <div class="row">
            <div class="col-xs-12 col md-6">
                <div class="business">
                    <img src="{{'../img/business.jpg'}}" alt="">
                </div>
            </div>
            <div class="col-xs-12 col md-6">
                <div class="aziende">
                    <h2>Deliveroo per le Aziende</h2>
                        <p>Clienti o colleghi affamati? il nostro team Corporate ti può aiutare.</p>
                    <button type="button" name="button">Contattaci</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="app_google">
                    <h2>Hai già la nostra app?</h2>
                        <p>Scaricala ora - disponibile su Apple store e Google Play!</p>
                    <img src="{{'../img/appicon.png'}}" alt="">
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="deliveroo_icon">
                    <img src="{{'../img/bunny.png'}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="lavora_con_noi">
    <div class="container">
        <h1>Lavora con Deliveroo</h1>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="banner_verticale red">
                    <img src="{{'../img/riders.jpg'}}" alt="">
                        <h2>Rider</h2>
                        <p>Diventa un rider: flessibilità, ottimi guadagni e un mondo di vantaggi per te.</p>
                    <button type="button" name="button">Unisciti a noi</button>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="banner_verticale orange">
                    <img src="{{'../img/restaurants.jpg'}}" alt="">
                        <h2>Ristoranti</h2>
                        <p>Diventa partner di Deliveroo e raggiungi sempre più clienti. Ci occupiamo noi della consegna, così che la tua unica preoccupazione sia continuare a preparare il miglior cibo.</p>
                    <button type="button" name="button">Diventa nostro partner</button>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="banner_verticale violet">
                    <img src="{{'../img/team.jpg'}}" alt="">
                        <h2>Lavora con noi</h2>
                        <p>La nostra missione è trasformare il modo in cui le persone mangiano. È un obiettivo ambizioso, come noi, e ci servono persone che ci aiutino a raggiungerlo.</p>
                    <button type="button" name="button">Scopri di più</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var preloader = document.getElementById("loading");

    function myFunction() {
        preloader.style.display = "none";
    }
</script>

@endsection
