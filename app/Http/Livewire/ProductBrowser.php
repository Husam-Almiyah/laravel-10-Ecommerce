<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public function render()
    {
            
            $products = Product::search('', function ($meilisearch, string $query, array $options){ 
                 
                $options['filter'] = 'category_ids = ' . $this->category->id;

                return $meilisearch->search($query, $options);
            })->get();

        return view('livewire.product-browser', [
            'products' => $products,
        ]);
    }
}
