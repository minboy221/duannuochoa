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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('full_name')->after('user_id')->nullable();
            $table->string('phone')->after('full_name')->nullable();
            $table->text('address')->after('phone')->nullable();
            $table->text('note')->after('address')->nullable();
            $table->string('payment_method')->after('total_amount')->default('cod');
            $table->string('payment_status')->after('payment_method')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'phone', 'address', 'note', 'payment_method', 'payment_status']);
        });
    }
};
