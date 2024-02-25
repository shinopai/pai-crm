<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned()->comment('購入数量');
            $table->dateTime('purchase_datetime')->comment('購入日時');
            $table->timestamps();

            $table->foreignId('customer_id')
                            ->constrained()
                            ->onDelete('cascade');
            $table->foreignId('item_id')
                            ->constrained()
                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_items');
    }
};
