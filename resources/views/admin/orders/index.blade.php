@extends('layouts.dashboard')


@section('admin.content')
    {{-- {{dd($orders)}} --}}
    @if(!$restaurant)
        <h1 class="back-dish-title" style="color: #440063">Non hai ristoranti</h1>
    @else
        <div id="root">
            @if (count($orders) == 0)
                <h2 class="back-dish-title">Non ci sono ordini</h2>
            @else
                <div class="header-card-restaurants d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ url('/') }}">
                        <img class="logo-admin-dish" src="{{asset('../img/logo.png')}}" alt="logo">
                    </a>                    <h1 class="title-order">Ordini del tuo ristorante</h1>
                </div>
                <div class="container">
                    <div class="row row-border-bottom color-p">
                        <div class="col-3">
                            <p class="order-p d-inline font-weight-bold">
                                ID
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="order-p d-inline font-weight-bold">
                                Nome cliente
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="order-p d-inline font-weight-bold">
                                Totale ordine
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="order-p d-inline font-weight-bold">
                                Operazioni
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    @foreach ($orders as $order)
                        <div class="row row-border-bottom">
                            <div class="col-3">
                                <p class="d-inline p-order-row">
                                    {{ $order->id }}
                                </p>
                            </div>
                            <div class="col-3">
                                <p class="d-inline p-order-row">
                                    {{ $order->guest_name }}
                                </p>
                            </div>
                            <div class="col-3">
                                <p class="d-inline p-order-row">
                                    {{ $order->final_price }} €
                                </p>
                            </div>
                            <div class="col-3">
                                <button onclick="show('{{ $order->id }}')" class="btn show-btn-deliveroo button9">Mostra Dettagli</button>
                                <button onclick="show('{{ $order->id }}')" class="btn show show-btn-deliveroo color-blue"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div style="display:none" id="{{ $order->id }}" class="hide-order-div">
                            <p class="hide-order-p">ID dell'ordine: <span class="hide-order-span">{{$order->id}}</span></p>
                            <p class="hide-order-p">Nome e Cognome del cliente: <span class="hide-order-span">{{$order->guest_name}} {{$order->guest_lastname}}</span></p>
                            <p class="hide-order-p">Indirizzo del cliente: <span class="hide-order-span">{{$order->guest_city}}, {{$order->guest_address}}</span></p>
                            <p class="hide-order-p">Telefono del cliente: <span class="hide-order-span">{{$order->guest_mobile}}</span></p>
                            <p class="hide-order-p">Email del cliente: <span class="hide-order-span">{{$order->guest_email}}</span></p>
                            <p class="hide-order-p">Totale dell'ordine senza spese di spedizione o sconti: <span class="hide-order-span">{{ $order->order_price }} €</span></p>
                            <p class="hide-order-p">Spese di spedizione: <span class="hide-order-span">{{ $order->delivery_price }} €</span></p>
                            <p class="hide-order-p">Sconto sull'ordine: <span class="hide-order-span">{{ $order->discount }} €</span></p>
                            <p class="hide-order-p">Totale definitivo: <span class="hide-order-span">{{ $order->final_price }} €</span></p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <script type="text/javascript">

    function show(id){
        if (document.getElementById){
            if(document.getElementById(id).style.display == 'none'){
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    }

    function hide(id) {
        if(document.getElementById(id).style.display == 'block'){
            document.getElementById(id).style.display = 'none;';
        }
    }

    </script>
@endsection
