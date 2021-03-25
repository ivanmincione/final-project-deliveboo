@extends('layouts.app')

@section('content')
    <div class="logo-form d-flex justify-content-center">
        <img src="{{asset('img/logo.png')}}" alt="logo deliveroo">
    </div>
<div class="container" style="min-height:60vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-5">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form name="myRegistrationForm" method="POST" action="{{ route('register') }}" onsubmit="return validateRegForm()">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control-deliveroo @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control-deliveroo @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control-deliveroo @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control-deliveroo" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita Iva') }}</label>

                            <div class="col-md-6">
                                <input id="iva" type="text" maxlength="11" class="form-control-deliveroo @error('iva') is-invalid @enderror" name="iva" required autocomplete="new-iva">

                                @error('iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-deliveroo">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validateRegForm() {

        var name = document.forms["myRegistrationForm"]["name"].value;
        var email = document.forms["myRegistrationForm"]["email"].value;
        var password = document.forms["myRegistrationForm"]["password"].value;
        var confirmPassword = document.forms["myRegistrationForm"]["password_confirmation"].value;
        var vatNumber = document.forms["myRegistrationForm"]["iva"].value;

        // controllo sul nome
        if (name == "" || name == "undefined") {
            alert("Non hai inserito il tuo nome");
            return false;
        };

        // controllo sull'email
        var validEmail = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
        if (!validEmail.test(email) || (email == "") || email == "undefined") {
            alert("Devi inserire un indirizzo email corretto");
            return false;
        };

        // controllo sulla password
        if (password.length < 8 || (password == "") || password == "undefined") {
            alert("Scegli una password con minimo 8 caratteri");
            return false;
        };

        // controllo sulla conferma della password
        if ((confirmPassword == "") || (confirmPassword == "undefined")) {
            alert("Devi confermare la password");
            return false;
        };

        // controllo sulla partita iva
        var validVatNumber = /^[0-9]{11}$/;
        if (isNaN(vatNumber) || !validVatNumber.test(vatNumber) || vatNumber == "" || vatNumber == "undefined" ) {
            alert("Devi inserire una partita iva di 11 numeri");
            return false;
        };
    }
</script>
@endsection
