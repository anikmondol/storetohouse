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
        Schema::create('damages', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable();
            $table->string('item_name');
            $table->string('entry_by');
            $table->date('damage_date');
            $table->integer('item_qty');
            $table->text('item_description')->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('damages', function (Blueprint $table) {
            //
        });
    }
};
