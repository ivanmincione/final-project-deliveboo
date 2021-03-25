@extends('layouts.app')


@section('content')
    <div class="nav-bar-container nav-cart-border-bottom">
        <div class="row m-0">
            <div class="col p-0">
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
            </div>
        </div>
    </div>
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
        <div class="container">
            <div class="checkout-without-container">
                <h1 class="text-center mb-5">Non ci sono prodotti nel carrello</h1>
                <a href="{{ route('guest.restaurants') }}">
                    <button type="submit" class="btn btn-deliveroo">Torna allo shopping</button>
                </a>
            </div>

        </div>
    @else
        <span id="status"></span>

        <h1 class="text-center mb-4"> Il tuo carrello</h1>
        <div class="d-flex justify-content-center align-item-center mb-3">
            <marquee id="marquee-cart" class="p-2" style="background-color: #00ccbc; color: #fff;" loop="-1" direction="left"> Con un ordine superiore ai 30€, la consegna è gratuita ! </marquee>
        </div>

        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Piatti</th>
                <th style="width:10%">Prezzo</th>
                <th style="width:8%">Quantità</th>
                <th style="width:22%" class="text-center">Subtotale</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>

                {{-- {{dd(session('mainRestaurantId'))}} --}}
            <?php $total = 0 ?>
            @if(session('cart'))
                @foreach((array) session('cart') as $id => $details)
                    {{-- {{dd($details['restaurant_id'])}} --}}
                    <?php $total += $details['price'] * $details['quantity'] ?>

                    <tr>
                        <td data-th="Product" >
                            <div class="row cart-title-container">
                                <div class="col-sm-3 hidden-xs">
                                    {{-- <img src="{{ asset('storage/' . $details['cover']) }}" width="100" height="100" class="img-responsive"/> --}}
                                    @if ((file_exists('storage/' . $details['cover'])))
                                        <img src="{{ asset('storage/' . $details['cover'])}}" alt="Cover piatto" class="img-fluid cart-fluid">
                                    @else
                                        <img src="{{ asset('storage/dishesCover/non-disponibile.png') }}" alt="Cover piatto" class="img-fluid cart-fluid">
                                    @endif
                                </div>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price" >€ <span class="hideItem">{{ $details['price'] }}</span></td>
                        <td data-th="Quantity">
                            <input type="number" min="1" value="{{ $details['quantity'] }}" class="form-control quantity"/>
                        </td>
                        <td data-th="Subtotal" class="text-center">€ <span class="product-subtotal hideItem">{{ $details['price'] * $details['quantity'] }}</span></td>
                        <td class="actions" data-th="">
                            <div class="cart-button-container">
                                {{-- refresh da azzurro a giallo --}}
                                <button class="btn btn-warning btn-sm update-cart p-2" data-id="{{ $id }}"><i class="fas fa-sync-alt"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cart p-2" data-id="{{ $id }}"><i class="fas fa-trash-alt"></i></button>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            {{-- salviamo tempo di consegna sempre 30 minuti --}}
            {{session((['delivery_time' => 3000]))}}
            </tbody>
                <td><a href="{{ route('guest.restaurants') }}" class="btn btn-deliveroo"><i class="fa fa-angle-left"></i> Continua lo Shopping</a></td>
                <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Subtotale € <span class="cart-total hideItem">{{ number_format($total, 2) }}</span></strong></td>
                    {{session((['order_price' => number_format($total, 2)]))}}
                </tr>
                @php $discount = $total * 10 / 100; number_format($discount, 2); @endphp
                @if ($total >= 30)
                    <tr class="visible-xs">
                        <td class="text-center"> <img src="{{asset("img/icon-deliveryman.png")}}" width="30px" height="30px" alt="icon"> <strong>Consegna gratuita</strong></td>
                        {{session((['delivery_price' => 0]))}}
                    </tr>
                    <tr class="visible-xs">
                        <td class="text-center"> <i class="fas fa-percent"></i> <strong>Sconto € <span class="cart-total hideItem">{{ number_format($discount, 2) }}</span></strong></td>
                        {{session((['discount' => number_format($discount, 2)]))}}
                    </tr>
                @elseif (session('cart'))
                    <tr class="visible-xs">
                        <td class="text-center"> <img src="{{asset("img/icon-deliveryman.png")}}" width="30px" height="30px" alt="icon"> <strong>Spese di consegna € <span class="cart-total hideItem">5</span></strong></td>
                        {{session((['delivery_price' => 5]))}}
                        {{session((['discount' => 0]))}}
                    </tr>
                @endif
                <tr>
                @if ($total >= 30)
                    @php
                        $final_price = $total + 0 - $discount;
                    @endphp
                    <td class="hidden-xs text-center"> <i class="fas fa-tag"></i> <strong>Totale € <span class="cart-total hideItem">{{ number_format($final_price, 2) }}</span></strong></td>
                    {{session((['final_price' => number_format($final_price, 2)]))}}
                @elseif (session('cart'))
                    @php
                        $final_price = $total + 5;
                    @endphp
                    <td class="hidden-xs text-center"> <i class="fas fa-tag"></i> <strong>Totale ordine € <span class="cart-total hideItem">{{ number_format($final_price, 2) }}</span></strong></td>
                    {{session((['final_price' => number_format($final_price, 2)]))}}
                @endif
                {{-- <td class="hidden-xs text-center"><strong>Totale € <span class="cart-total">{{ $total }}</span></strong></td> --}}

                <td colspan="2" class="hidden-xs"></td>
                <td>
                    <a href="{{ route('checkout.index') }}" class="btn btn-deliveroo">Procedi con l'ordine</a>
                </td>
            </tr>
            </tfoot>
        </table>
    @endif

    <script type="text/javascript">

     // const Swal = require('sweetalert2')

     //FUNZIONE DI AGGIORNAMENTO PIATTO NEL CARRELLO
        $(".update-cart").click(function (e) {
            e.preventDefault();

            let timerInterval
            Swal.fire({
                imageUrl: '{{ asset('img/logo.png') }}',
                title: 'Stiamo aggiornando il tuo carrello!',
                html: 'Attendi',
                // html: element: data-backdrop="static", data-keyboard="false",
                customClass: 'popupCartCustom',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 1)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
            })

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val();

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");

            var loading = parent_row.find(".btn-loading");

            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {

                    document.location.reload();
                    $('.hideItem').css({'display':'none'});
                    loading.hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    cart_total.text(response.total);

                }
            });
        });


        //Funzione di rimozione piatto dal carrello
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                  },
                  buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Vuoi rimuovere il piatto dal carrello?',
                  text: "",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Elimina',
                  cancelButtonText: 'Mantieni',
                  reverseButtons: true
                }).then((result) => {

                    var ele = $(this);

                    var parent_row = ele.parents("tr");

                    var cart_total = $(".cart-total");

                    // (confirm("Are you sure"))
                    if (result.isConfirmed) {
                        {
                            $.ajax({
                                url: '{{ url('remove-from-cart') }}',
                                method: "DELETE",
                                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                                dataType: "json",
                                success: function (response) {
                                    location.reload();
                                    $('.hideItem').css({'display':'none'});

                                    parent_row.remove();
                                    $("span#status").html('<div class="alert alert-danger">'+response.msg+'</div>');
                                    $("#header-bar").html(response.data);
                                    cart_total.text(response.total);
                                }
                            });
                        }
                      swalWithBootstrapButtons.fire(
                        'Eliminato',
                        'Il piatto è stato rimosso',
                        'success'
                      )
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      swalWithBootstrapButtons.fire(
                        'Piatto salvato',
                        'Il tuo piatto è nel carrello :)',
                        'success'
                     )
                }
            })
        });

    </script>

@endsection

{{-- @section('scripts') --}}




{{-- @endsection --}}
