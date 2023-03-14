<x-app-layout>
    <x-slot name="header">
        <div class="space-x-1">
            @foreach ($category->ancestors->reverse() as $ancestors)
                <a href="/categories/{{ $ancestors->slug }}" class="text-indigo-500">
                    {{ $ancestors->title }}
                </a>

                <span class="font-bold text-gray-300 last:hidden">/</span>
            @endforeach
        </div>

        <h2 class="mt-1 font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->title }}
        </h2>
    </x-slot>

    <livewire:product-browser :category="$category" />
</x-app-layout>
