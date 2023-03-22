<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('email');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('shipping_address_id')->constrained();
            $table->foreignId('shipping_type_id')->constrained();
            $table->integer('subtotal');
            $table->timestamp('placed_at');
            $table->timestamp('packaged_at');
            $table->timestamp('shipped_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
