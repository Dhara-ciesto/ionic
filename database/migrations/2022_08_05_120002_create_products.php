<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->integer('product_brand_id')->unsigned();
            $table->foreignId('product_brand_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->string('size');
            $table->foreignId('size_unit')->constrained()->on('units');
            $table->foreignId('fragrance_tone_1')->constrained()->on('fragrance_tones');
            $table->foreignId('scent_type_id')->constrained()->on('scent_types');
            $table->foreignId('fragrance_tone_2')->constrained()->on('fragrance_tones')->nullable();
            $table->string('fragrance_top_note')->nullable();
            $table->string('fragrance_middle_note')->nullable();
            $table->string('fragrance_base_note')->nullable();
            $table->string('occasion')->nullable();
            $table->string('fragrance_description')->nullable();
            $table->integer('price');
            $table->string('url')->nullable();
            $table->string('gender');
            $table->foreignId('campaign')->constrained()->on('campaign')->nullable();
            $table->string('file')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
