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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('顧客名');
            $table->string('tel')->comment('電話番号');
            $table->string('email')->comment('メールアドレス');
            $table->string('postcode', 7)->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->date('birthday')->comment('誕生日');
            $table->enum('gender', ['男性', '女性'])->comment('性別');
            $table->text('memo')->nullable()->comment('顧客に関するメモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
