@extends('layouts.dashboard')

@section('admin.content')
<div class="container border-form p-5">
    <div class="row justify-content-center">
        <div class="col 12">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif --}}
            <h1>Modifica il tuo piatto</h1>
            <form name="myDishModifyForm" method="POST" action="{{ route('admin.dishes.update', ['dish' => $dish->slug]) }}" enctype="multipart/form-data" onsubmit="return validateDishModifyForm()">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="dishName">Nome del piatto</label>
                    <input type="text" id="dishName" class="form-control-deliveroo" placeholder="Inserisci il nome" name="name" value="{{ old('name', $dish->name) }}" required maxlength="100">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lorem ipsum dolor sit amet.</small>
                </div>
                <div class="form-group">
                    <label for="dishImage">Inserisci l'immagine del piatto</label>
                    <input id="dishImage" type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="dishDescription">Descrizione del piatto</label>
                  <textarea class="form-control-deliveroo" id="dishDescription" rows="3" cols="8" placeholder="Inserisci la descrizione e/o gli ingredienti" name="description" required>{{ old('description', $dish->description) }}</textarea>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="dishPrice">Prezzo del piatto</label>
                    <input type="number" id="dishPrice" class="form-control-deliveroo" min="1" step="0.01" placeholder="€" name="price" value="{{ old('price', $dish->price) }}" required>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Disponibile?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="visible" id="visibleYes" value="1" required>
                        <label class="form-check-label" for="visibleYes">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="visible" id="visibleNo" value="0" required>
                        <label class="form-check-label" for="visibleNo">No</label>
                    </div>
                    @error('visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-deliveroo">Modifica</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validateDishModifyForm() {
        var name = document.forms["myDishModifyForm"]["name"].value;
        var file = document.forms["myDishModifyForm"]["image"].value;
        var description = document.forms["myDishModifyForm"]["description"].value;
        var price = document.forms["myDishModifyForm"]["price"].value;
        var visibleYes = document.getElementById('visibleYes').checked;
        var visibleNo = document.getElementById('visibleNo').checked;

        // controllo sul nome del piatto
        if (name == "" || name == "undefined") {
            alert ("Non hai inserito il nome del tuo piatto");
            return false;
        } else if ( name.length > 100) {
            alert ("La lunghezzo del nome non può superare i 100 caratteri");
            return false;
        };

        // controllo sull'immagine
        var idxDot = file.lastIndexOf(".") + 1;
        var extFile = file.substr(idxDot, file.length).toLowerCase();
        if (file == "") {
            return true;
        } else if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "svg"){
            return true;
        } else {
            alert( "Sono supportati solo formati jpg/jpeg, png e svg");
            file = "";
            return false;
        };

        // // controllo sulla descrizione
        // if (description == "" || description == "undefined") {
        //     alert ("Non hai scritto alcuna descrizione del piatto");
        //     return false;
        // }
        //
        // // controllo sul prezzo
        // if (price == "" || price == "undefined") {
        //     alert ("Non hai inserito il prezzo del tuo piatto");
        //     return false;
        // } else if (!isNaN(price)) {
        //     alert ("Il prezzo del tuo piatto deve essere un numero");
        //     return false;
        // } else if (price < 0) {
        //     alert ("Il prezzo del tuo piatto non può essere negativo");
        //     return false;
        // };
        //
        // // controllo su radio visible
        // if (!visibleYes && !visibleNo) {
        //     alert ("Non hai espresso la tua preferenza");
        //     return false;
        // };
    }
</script>
@endsection
