@extends('layouts.dashboard')

@section('admin.content')
<div class="container border-form p-5">
    <div class="row justify-content-center">
        <div class="col 12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <h1>Inserisci i dati del tuo Ristorante</h1>
            <form name="myRestaurantForm" method="POST" action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data" onsubmit="return validateRestaurantForm()">
                @csrf
                <div class="form-group">
                    <label for="restaurantName">Nome</label>
                    <input type="text" id="restaurantName" class="form-control-deliveroo" placeholder="Inserisci il nome del tuo ristorante" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="restaurantCity">Città</label>
                    <input type="text" id="restaurantCity" class="form-control-deliveroo" placeholder="Inserisci la città del tuo ristorante" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="restaurantAddress">Indirizzo</label>
                    <input type="text" id="restaurantAddress" class="form-control-deliveroo" placeholder="Inserisci l'indirizzo del tuo ristorante" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="restaurantImage">Inserisci l'immagine del ristorante</label>
                    <input id="restaurantImage" type="file" name="image" class="form-control-file" >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="restaurantDescription">Descrizione</label>
                    <input type="text" id="restaurantDescription" class="form-control-deliveroo" placeholder="Inserisci la descrizione del tuo ristorante" name="description" value="{{ old('description') }}" required>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <p>Seleziona le categorie:</p>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', [])) ? 'checked=checked' : '' }}>
                            <label class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('categories')
                       <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-deliveroo">Invio</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validateRestaurantForm() {
        var name = document.forms["myRestaurantForm"]["name"].value;
        var city = document.forms["myRestaurantForm"]["city"].value;
        var address = document.forms["myRestaurantForm"]["address"].value;
        var address = document.forms["myRestaurantForm"]["description"].value;

        // controllo sul nome del ristorante
        if (name == "" || name == "undefined") {
            alert ("Non hai inserito il nome del tuo ristorante");
            return false;
        } else if ( name.length > 100) {
            alert ("La lunghezzo del nome non può superare i 100 caratteri");
            return false;
        };

        // controllo sulla citta
        if (city == "" || city == "undefined") {
            alert ("Non hai inserito il nome della città o la lunghezza supera i 100 caratteri");
            return false;
        } else if ( city.length > 100) {
            alert ("La lunghezzo del nome della città non può superare i 100 caratteri");
            return false;
        };

        // controllo sull'indirizzo del ristorante
        if (address == "" || address == "undefined" ) {
            alert ("Non hai inserito l'indirizzo del tuo ristorante o la lunghezza supera i 100 caratteri");
            return false;
        } else if ( address.length > 100) {
            alert ("La lunghezza del nome dell'indirizzo non può superare i 100 caratteri");
            return false;
        };

        // controllo sulla descrizione del ristorante
        if (description == "" || description == "undefined" ) {
            alert ("Non hai inserito la descrizione del tuo ristorante o la lunghezza supera i 200 caratteri");
            return false;
        } else if ( description.length > 200) {
            alert ("La lunghezza del nome della descrizione non può superare i 200 caratteri");
            return false;
        };
        // // controllo sulle checkbox delle categorie
        var selected = false;
        for (var i=0; i<document.forms["myRestaurantForm"].elements.length; i++){
            if (document.forms["myRestaurantForm"].elements[i].type && document.forms["myRestaurantForm"].elements[i].type.toLowerCase() == "checkbox" && document.forms["myRestaurantForm"].elements[i].checked)
            selected = true;
        }
        if (!selected){
            alert ("Devi spuntare almeno una categoria");
        };
    }

</script>
@endsection
