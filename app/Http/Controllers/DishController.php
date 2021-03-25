<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;

use App\Restaurant;

class DishController extends Controller
{

        // TEST Carrello

    public function index()
    {
        $dishes = Dish::all();
        $restaurants = Restaurant::all();

        return view('guest.restaurants.show', compact('dishes', "restaurants"));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        // session_start();

        $restaurant = Restaurant::all();
        // $dish = Dish::where('restaurant_id' == $restaurant->id);

        $dish = Dish::find($id);



        if(!$dish)  {

            abort(404);

        }

        if (empty(session()->get('cart'))) {
            $restaurantMainId = $dish->restaurant_id;
        }

        $cart = session()->get('cart');

        if(!$cart) {

            $cart = [
                $id => [
                    "id" => $dish->id,
                    "name" => $dish->name,
                    "quantity" => 1,
                    "price" => $dish->price,
                    "cover" => $dish->cover,
                    "restaurant_id" => $dish->restaurant_id
                ]

            ];

            session(['mainRestaurantId' => $restaurantMainId]);
            session()->put('cart', $cart);
            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        }

        // se il carrello non è vuoto, check del prodotto e aumento della quantità
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);
            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);

        }


        $mainId = session('mainRestaurantId');
        // se il prodotto non esiste nel carrello, viene aggiunto con quantità = 1
            $cart[$id] = [
                "id" => $dish->id,
                "name" => $dish->name,
                "quantity" => 1,
                "price" => $dish->price,
                "cover" => $dish->cover,
                "restaurant_id" => $dish->restaurant_id,
            ];

            if ($cart[$id]['restaurant_id'] == $mainId) {
            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Prodotto aggiunto al carrello!', 'data' => $htmlCart]);
        } else {
            // alert("Attenzione!! Non puoi prenotare da più ristoranti");
            return response()->json(['error' => 'Attenzione!! Non puoi prenotare da più ristoranti']);

        }



    }


    public function update(Request $request)
    {
        // dd($request);
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            // $discount = session()->get('discount');

            $cart[$request->id]["quantity"] = $request->quantity;
            // $discount[$request->id]["discount"] = $request->quantity;

            session()->put('cart', $cart);
            // session()->put('discount', $discount);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            // parent.window.location.reload();

            return response()->json(['msg' => 'Carrello aggiornato', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);

            //session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');
            // $discount = session()->get('discount');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            // if(isset($discount[$request->id])) {
            //
            //     unset($discount[$request->id]);
            //
            //     session()->put('discount', $discount);
            // }

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            // parent.window.location.reload();

            return response()->json(['msg' => 'Prodotto rimosso!', 'data' => $htmlCart, 'total' => $total]);

            //session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }

}
