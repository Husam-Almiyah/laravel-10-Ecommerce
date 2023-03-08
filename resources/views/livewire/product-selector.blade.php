<div class="space-y-6">
    
    @if ($initialVariation)

        <livewire:product-variation-dropdown :variations="$initialVariation" />
        
    @endif

    @if ($skuVariant)
        <div class="space-y-6">
            <div class="font-semibold text-lg">
                {{ $skuVariant -> formattedPrice() }}
            </div>
            <x-secondary-button wire:click.prevent="addToCart">Add to cart</x-secondary-button>
        </div>
    @endif 

</div>
