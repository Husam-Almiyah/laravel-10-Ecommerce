<?php

namespace App\Listeners;

use App\Models\Order;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttachOrders
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        Order::where('email', $event->user->email)->get()->each(function ($order) use($event) {
            $order->user()->associate($event->user);
            $order->save();
        });
    }
}
