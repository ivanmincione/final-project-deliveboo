<div class="container restaurant-cart-container">
    <div id="header-bar" class="main-section">
        <div class="dropdown">
            <button id="open"onclick=popup() type="button" class="btn btn-deliveroo" data-toggle="dropdown">
                @if (!session()->get('cart'))
                    <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> 0 €</span>

                @else
                    @php
                    $elementi = session()->get('cart');
                    $totale = 0;
                    @endphp

                    {{-- {{dd($elementi)}} --}}
                    {{-- {{ dd($elementi) }} --}}
                    @foreach ($elementi as $element)
                        @php
                        $subtotale = $element['price'] * $element['quantity'];
                        $totale = $subtotale + $totale;
                        @endphp

                    @endforeach
                    <i class="fa fa-shopping-cart p-1" aria-hidden="true"></i><span class="badge badge-pill badge-danger"> {{ $totale }} €</span>
                @endif

            </button>
            <div id="pop" class="dropdown-menu p-4">
                <div class="row total-header-section">
                    <div class="col-xs-7 col-lg-7 col-sm-7 col-7">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </div>

                    <?php $total = 0 ?>
                    @foreach((array) session('cart') as $id => $details)
                        <?php $total += $details['price'] * $details['quantity'] ?>
                        {{-- {{dd($details)}} --}}
                    @endforeach

                    <div class="col-lg-5 col-sm-5 col-5 total-section text-right">
                        <p>Totale: <span class="text-info">€ {{ $total }}</span></p>
                    </div>
                </div>

                @if(session('cart'))
                    @foreach((array) session('cart') as $id => $details)
                        <div class="row cart-detail">
                            <button style="color:red" class="btn remove-from-cart p-1" data-id="{{ $id }}"><i class="far fa-trash-alt"></i></button>
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                @if ((file_exists('storage/' . $details['cover'])))
                                    <img src="{{ asset('storage/' . $details['cover'])}}" alt="Cover piatto" class="img-fluid">
                                @else
                                    <img src="{{ asset('storage/dishesCover/non-disponibile.png') }}" alt="Cover piatto" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-lg-6 col-sm-6 col-6 cart-detail-product">
                                <p>{{ $details['name'] }}</p>
                                <span class="price text-info"> €{{ $details['price'] }}</span> <span class="count"> Quantità:{{ $details['quantity'] }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                        <a href="{{ url('cart') }}" class="btn btn-deliveroo btn-block">Vai al carrello</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    //function for opening the popup
    function popup(){
        var mes=document.getElementById('pop');
        mes.style.transform="scale(1)";
        mes.style.transitionTimingFunction="cubic-bezier(0,0,0,1.47)";
        navigator.vibrate(250);
    }

    //function for closing the popup
    function popin(){
        var mes=document.getElementById('pop');
        mes.style.transform="scale(0)";
        mes.style.transitionTimingFunction="cubic-bezier(0,0,0,-1.47)";
    }

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        var parent_row = ele.parents("tr");

        var cart_total = $(".cart-total");


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


    });
</script>
