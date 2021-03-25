@extends('layouts.dashboard')

@section('admin.content')
<div class="container h-100 d-flex flex-column">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="header-card-restaurants d-flex flex-column justify-content-center align-items-center">
                <a href="{{ url('/') }}">
                    <img class="logo-admin-dish" src="{{asset('../img/logo.png')}}" alt="">
                </a>
                <h1>Il tuo ristorante</h1>
                {{-- @if (is_null($restaurant))
                    <a href="{{ route('admin.restaurants.create') }}">
                        <button type="button" class="btn btn-deliveroo">Aggiungi nuovo ristorante</button>
                        <button type="button" class="btn add btn-deliveroo"><i class="fas fa-plus"></i></button>
                    </a>
                @endif --}}
            </div>
        </div>
    </div>
    @if (!is_null($restaurant))
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-container">
                    <div class="card-d card-resta w-100">
                        @if ($restaurant->cover)
                            <div class="card-b">
                                <img src="{{ asset('storage/' . $restaurant->cover) }}" alt="{{ $restaurant->name }}"/>
                            </div>
                        @else
                            <div class="card-b">
                                <img src="{{ asset('storage/restaurantsCover/non-disponibile.png') }}" alt="{{ $restaurant->name }}"/>
                            </div>
                        @endif
                        <ul class="list-group list-group-flush">
                            <h5 class="card-title restaurant-info">Nome: {{$restaurant->name}}</h5>
                            <li class="list-group-item restaurant-info">Citta: {{$restaurant->city}}</li>
                            <li class="list-group-item restaurant-info">Indirizzo: {{$restaurant->address}}</li>
                            @foreach ($categories as $category)
                                <li class="list-group-item restaurant-info">Categoria: {{$category->name}}</li>
                            @endforeach
                        </ul>
                        <div class="card-c text-center">

                            <a href="{{ route('admin.dishes.index') }}" class=""><button class="button9" type="button" name="button">Il Menu del tuo ristorante <i class="fas fa-book-open"></i></button></a>
                            <a href="#" class="button_no">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container no-restaurant d-flex flex-column justify-content-center align-items-center m-auto">
            <h1 class="info-alert text-center">Non hai ristoranti</h1>
            <a href="{{ route('admin.restaurants.create') }}">
                <button type="button" class="btn btn-deliveroo">Aggiungi nuovo ristorante</button>
            </a>
        </div>
    @endif
</div>
@endsection
