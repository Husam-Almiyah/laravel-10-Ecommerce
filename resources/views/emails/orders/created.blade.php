<x-mail::message>
# The status of your order (#{{ $order->id }}) has been placed

Your order has been placed

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
