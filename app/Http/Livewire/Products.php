<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    public $products;
    public function mount()
    {
        $this->products = Product::all();
    }

    public function checkout()
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SCERETE_KEY'));
        $products = Product::all();
        $lineItems = [];
        $total_price = 0;
        foreach ($products as $product) {
            $total_price += $product->price;
            $lineItems = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->Product_name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ];
        }
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], absolute: true),
            'cancel_url' => route('checkout.cancel', [], absolute: true),
        ]);

        $order = new Order();
        $order->statuse = 'unpaind';
        $order->total_price = $total_price;
        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }


    public function success()
    {
    }

    public function cancel()
    {
    }



    public function render()
    {
        return view('livewire.product');
    }
}
