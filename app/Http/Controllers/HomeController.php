<?php

namespace App\Http\Controllers;

use App\Cart\Contracts\CartInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __invoke(CartInterface $cart)
    {

        $cart->create();

        $categories = Category::tree()->get()->toTree();
        // $categories = Category::tree()->toSql();

        return view('home', [
            'categories' => $categories,
        ]);
    }
}
