<?php

namespace App\Http\Controllers;

use App\Cart\Contracts\CartInterface;
use App\Cart\Exceptions\QuantityNoLongerAvailable;
use App\Http\Middleware\RedirectIfCartEmpty;
use Illuminate\Http\Request;

class CheckoutIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfCartEmpty::class);
    }

    public function __invoke(CartInterface $cart)
    {
        try {

            $cart->verifyAvailableQuantities();

        } catch (QuantityNoLongerAvailable $ex) {

            $cart->syncAvailableQuantities();
            
        }
        
        return view('products.checkout');
    }
}
