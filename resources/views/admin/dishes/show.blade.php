@extends('layouts.dashboard')

@section('admin.content')
<div class="container">
    <div class="row justify-content-center">
            <div class="ft-recipe col-xs-12 col-md-6">
              <div class="ft-recipe__content">
                <header class="content__header">
                  <div class="row-wrapper">
                    <h2 class="recipe-title capitalize"> {{ $dish->name }}</h2>
                    <div class="ft-recipe__thumb"></i></span>
                        @if ((file_exists('storage/' . $dish->cover)))
                            <img src="{{ asset('storage/' . $dish->cover) }}" alt="{{ $dish->name }}"/>
                        @else
                            <img src="{{ asset('storage/dishesCover/non-disponibile.png') }}" alt="{{ $dish->name }}"/>
                        @endif
                    </div>
                  </div>
                  <ul class="recipe-details">
                    <li class="recipe-details-item time"><i class="ion ion-ios-clock-outline"></i><span class="value">Prezzo:</span><span class="title">{{ $dish->price }}€</span></li>

                    <li class="recipe-details-item servings"><i class="ion ion-ios-person-outline"></i><span class="value">Visibile:</span><span class="title">{{ $dish->visible == 1 ? 'Si' : 'No' }}</span></li>
                  </ul>
                  <p class="value">Descrizione:</p><span class="title capitalize">{{ $dish->description }}</span>
                </header>
                <footer class="content__footer"><a href="{{ route('admin.dishes.index') }}">Tutti i piatti</a></footer>
              </div>
            </div>
        {{-- </div> --}}
    </div>
</div>
@endsection




{{-- <div class="card-show">
    <h1 class="capitalize">Nome del piatto: {{ $dish->name }}</h1>
    <div class="img-show">
        <img src="{{ asset('storage/' . $dish->cover) }}" alt="{{ $dish->name }}">
    </div>
    <p class="dish-info">Descrizione: {{ $dish->description }}</p>
    <p class="dish-info">Disponibile: {{ $dish->visible == 1 ? 'Yes' : 'No' }}</p>
    <p class="dish-info">Prezzo {{ $dish->price }}€</p>
</div>
<div class="back-to-dishes-arrow d-block">
    <a href="{{ route('admin.dishes.index') }}" class="d-block">
        <button class="btn all-dishes btn-deliveroo" type="button" name="button">
        <i class="fas fa-arrow-left"></i>Tutti i piatti</button>
    </a>
</div> --}}
