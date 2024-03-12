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
        Schema::create('az_restaurant_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('commission_value')->default(0);
            $table->string('transfer_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('az_restaurant_commissions');
    }
};
