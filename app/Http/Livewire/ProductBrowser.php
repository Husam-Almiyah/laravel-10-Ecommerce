<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public $queryFilters = [];

    public $priceRange = [
        'max' => null,
    ];

    public function mount()
    {
        $this->queryFilters = $this->category->products->pluck('variations')
        ->flatten()
        ->groupBy('type')
        ->keys()
        ->mapWithKeys( fn ($key) => [$key => []] )
        ->toArray();
    }

    public function render()
    {
        $search = Product::search('', function ($meilisearch, string $query, array $options){ 
            $filters = collect($this->queryFilters)
            ->filter(fn ($filter) => !empty($filter))
            ->recursive()
            ->map(function ($value, $key) {
                return $value->map(fn ($value) => $key . ' = "' . $value . '"');
                // Another way to write (fn) closure 
                // return $value->map(function ($value) use ($key) {
                //     return $key . '="' . $value . '" AND'; 
                //     }
                // );
            })
            ->flatten()
            ->join(' OR ');
                    
            $options['facets'] = ['size', 'color'];

            $options['filter'] = null;

            if ($filters)
            {
                $options['filter'] = $filters;
                // dd($options['filter']);
            }

            if ($this->priceRange['max'])
            {
                $options['filter'] .= (isset($options['filter']) ? ' AND ' : '') . 'price <= ' . $this->priceRange['max'];
            }

            // dd($options['filter']);

            return $meilisearch->search($query, $options);
        })->raw();
        
        $products = $this->category->products->find(collect($search['hits'])->pluck('id'));

        $maxPrice = $this->category->products->max('price');

        $this->priceRange['max'] = $this->priceRange['max'] ?: $maxPrice;

        return view('livewire.product-browser', [
            'products' => $products,
            'filters' => $search['facetDistribution'],
            'maxPrice' => $maxPrice,
        ]);
    }
}
