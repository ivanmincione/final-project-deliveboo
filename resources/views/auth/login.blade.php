@extends('layouts.app')

@section('content')
    <div class="logo-form d-flex justify-content-center">
        <img src="{{asset('img/logo.png')}}" alt="logo deliveroo">
    </div>
<div class="container" style="min-height:60vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-5">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form name="myLoginForm" method="POST" action="{{ route('login') }}" onsubmit="return validateLogForm()">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control-deliveroo @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control-deliveroo @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-deliveroo">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validateLogForm() {
        var email = document.forms["myLoginForm"]["email"].value;
        var password = document.forms["myLoginForm"]["password"].value;

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
    }
</script>
@endsection
