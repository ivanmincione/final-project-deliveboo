@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-restaurants">
                    <div class="logo-guest-restaurant">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{'../img/logo.png'}}" alt="logo deliveroo">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>

                    </div>
                </nav>
                @if(session('success_message'))
                    <div class="alert alert-success">
                        {{session('success_message')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                @if (!session()->get('cart'))
                    <div class="checkout-without-container">
                        <h1>Non ci sono prodotti nel carrello</h1>
                        <a href="{{ route('guest.restaurants') }}">
                            <button type="submit" class="btn btn-warning">Torna allo shopping</button>
                        </a>
                    </div>
                @else
                    {{-- PROVA NUOVA CARD --}}
                    <div class="checkout">
                        <div class="items-checkout">
                            @php $finalTotal = 0; @endphp
                            <h1 class="mb-4">Il tuo ordine</h1>
                            <div class="card card-checkout d-flex flex-column">
                                @foreach ($dishes as $dish)
                                    <div class="item-container">
                                        <span><strong>{{ $dish['quantity'] }} x</strong></span>
                                        <span>{{ $dish['name'] }}</span>
                                        <div id="info-dish">
                                            <div class="image-container">
                                                {{-- <img class="img-fluid" src="{{ asset('storage/'.$dish['cover']) }}" alt="immagine {{ $dish['name'] }}"> --}}
                                                @if ((file_exists('storage/' . $dish['cover'])))
                                                    <img src="{{ asset('storage/' . $dish['cover'])}}" alt="Cover piatto" class="img-fluid checkout-fluid">
                                                @else
                                                    <img src="{{ asset('storage/dishesCover/non-disponibile.png') }}" alt="Cover piatto" class="img-fluid checkout-fluid">
                                                @endif
                                            </div>
                                            <div id="price">
                                                <p class="price single">Prezzo unitario: <span>€ {{ $dish['price'] }}</span></p>
                                                <p class="price">Totale:<span> € {{ $dish['quantity'] * $dish['price'] }}</span></p>

                                            </div>
                                        </div>
                                    </div>
                                    @php $discount = session('discount'); @endphp
                                    @php $deliveryPrice = session('delivery_price'); @endphp
                                    {{-- @php $totalFinal = $finalTotal @endphp --}}

                                    @php $finalTotal += $dish['quantity'] * $dish['price']; @endphp
                                @endforeach
                                @php $finalTotalToPay = $finalTotal + $deliveryPrice - $discount; @endphp

                                {{-- {{dd($finalTotalToPay)}} --}}
                                <div class="checkout-card-total">
                                    <h3>Totale ordine: <span>€ {{$finalTotal}}</span></h3>
                                </div>
                                @if ($deliveryPrice > 0)
                                    <div class="checkout-card-total">
                                        <h3>Spese di consegna: <span>€ {{$deliveryPrice}}</span></h3>
                                    </div>
                                @else
                                    <div class="checkout-card-total">
                                        <h3>Consegna Gratuita</span></h3>
                                    </div>
                                @endif
                                @if ($discount > 0)
                                    <div class="checkout-card-total">
                                        <h3>Sconto: <span>€ {{$discount}}</span></h3>
                                    </div>
                                @endif
                                <div class="checkout-card-total" style="background-color: #5de2a3;">
                                    <h3>Totale da pagare: <span>€ {{$finalTotalToPay}}</span></h3>
                                </div>
                            </div>
                            <a href="{{ route('cart') }}">
                                <button type="button" class="btn btn-lg btn-deliveroo">Torna al carrello</button>
                            </a>
                        </div>
                        <div class="guest-data">
                            <h1 class="mb-4">Inserisci i tuoi dati</h1>
                            <form id="form" method="POST" name="formform" action="{{ route('checkout.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="guestName">Nome</label>
                                    <input type="text" id="guestName" class="form-control-deliveroo" placeholder="Inserisci il tuo nome" name="guest_name" value="{{ old('guest_name') }}" maxlength="100" required>
                                    @error('guest_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="guestLastname">Cognome</label>
                                    <input type="text" id="guestLastname" class="form-control-deliveroo" placeholder="Inserisci il tuo cognome" name="guest_lastname" value="{{ old('guest_lastname') }}" maxlength="100" required>
                                    @error('guest_lastname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="guestCity">Città</label>
                                    <input type="text" id="guestCity" class="form-control-deliveroo" placeholder="Inserisci la città di consegna" name="guest_city" value="{{ old('guest_city') }}" maxlength="100" required>
                                    @error('guest_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="guestAddress">Indirizzo</label>
                                    <input type="text" id="guestAddress" class="form-control-deliveroo" placeholder="Inserisci l'indirizzo di consegna" name="guest_address" value="{{ old('guest_address') }}" maxlength="100" required>
                                    @error('guest_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="checkout-mobile" for="guestMobile">Telefono</label>
                                    <span class="checkout-mobile">+39</span>
                                    <input type="text" id="guestMobile" class="form-control-deliveroo checkout-mobile" placeholder="Inserisci il tuo numero" name="guest_mobile" value="{{ old('guest_mobile') }}" maxlength="10" required>
                                    @error('guest_mobile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="guestEmail">Email</label>
                                    <input type="email" id="guestEmail" class="form-control-deliveroo" placeholder="Inserisci la tua email" name="guest_email" value="{{ old('guest_email') }}" maxlength="100" required>
                                    @error('guest_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div id="dropin-wrapper">
                                    <div id="dropin-container"></div>
                                </div>

                                {{-- input non visibili --}}

                                <input type="hidden" name="order_price" value="{{ session('order_price')}}">
                                <input type="hidden" name="delivery_price" value="{{ session('delivery_price')}}">
                                <input type="hidden" name="discount" value="{{ session('discount')}}">
                                <input type="hidden" name="final_price" value="{{ session('final_price')}}">

                                {{-- tempo della consegna in secondi --}}
                                <input type="hidden" name="delivery_time" value="{{ session('delivery_time')}}">




                                {{-- TEST BOTTONE INVIO PAGAMENTO --}}
                               <button type="submit" class="btn" id="submit-button">
                                   <div class="container-btn-send-payment">
                                    <div class="left-side">
                                     <div class="card-btn-send-payment">
                                      <div class="card-line"></div>
                                      <div class="buttons-send-payment"></div>
                                     </div>
                                     <div class="post-payment">
                                      <div class="post-line"></div>
                                      <div class="screen-btn-payment">
                                       <div class="dollar-btn-payment">€</div>
                                      </div>
                                      <div class="numbers-payment"></div>
                                      <div class="numbers-line2"></div>
                                     </div>
                                    </div>
                                    <div class="right-side">
                                     <div class="new-payment">Invia</div>

                                     <i class="fas fa-chevron-right arrow"></i>
                                    </div>
                                   </div>
                               </button>

                               {{-- FINE TEST BOTTONE INVIO PAGAMENTO --}}
                            </form>
                        </div>
                    </div>
                    {{-- FINE PROVA CARD --}}
                @endif
            </div>
        </div>
    </div>

@endsection

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script type="text/javascript">
    braintree.setup("{{ $token }}", "dropin", {
        container: "dropin-container",
        form: 'form'
    });
</script>
