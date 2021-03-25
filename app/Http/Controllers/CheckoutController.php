<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\Order;
use App\Payment;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index(Request $request) {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $cartItems = session()->get('cart');
        $data = [
            'dishes' => $cartItems,
            'token' => $gateway->ClientToken()->generate()
        ];
        // dd(session()->get('cart'));
        // dd($data);
        return view('checkout', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'guest_name' => 'required|max:100',
            'guest_lastname' => 'required|max:100',
            'guest_city' => 'required|max:100',
            'guest_address' => 'required|max:100',
            'guest_mobile' => 'required|numeric|gt:-1|max:9999999999',
            'guest_email' => 'email:rfc|required|max:100',
            'order_price' => ['required', Rule::in([session('order_price')])],
            'delivery_price' => ['required', Rule::in([session('delivery_price')])],
            'delivery_time' => ['required', Rule::in([session('delivery_time')])],
            'discount' => ['required', Rule::in([session('discount')])],
            'final_price' => ['required', Rule::in([session('final_price')])],
        ]);
        // dd($request);
        $data = $request->all();
        $newOrder = new Order();
        $newOrder->restaurant_id = session('mainRestaurantId');
        $newOrder->fill($data);
        $newOrder->save();
        $newPayment = new Payment();
        $newPayment->order_id = $newOrder->id;
        $newPayment->save();

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->get('payment_method_nonce');
        $amount = session()->get('final_price');

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            session()->forget('cart');
            return redirect()->route('postCheckout')->with('success_message', 'Transaction successful. The ID is:'.$transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('An error occurred with the message:'.$result->message);
        }
    }

    public function postCheckout() {
        
        return view('postCheckout');
    }
}
