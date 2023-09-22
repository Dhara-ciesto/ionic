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
            // $table->integer('product_brand_id');
            $table->foreign('product_brand_id')->references('id')->on('product_brands');
            $table->string('product_name');
            $table->string('size');
            $table->integer('size_unit');
            $table->foreign('size_unit')->references('id')->on('units');
            $table->integer('fragrance_tone_1')->references('id')->on('fragrance_tones');
            $table->integer('fragrance_tone_2')->references('id')->on('fragrance_tones')->nullable();
            $table->string('fragrance_top_note');
            $table->string('fragrance_middle_note');
            $table->string('fragrance_base_note');
            $table->string('occasion');
            $table->string('fragrance_description');
            $table->integer('price');
            $table->string('url');
            $table->string('gender');
            $table->string('campaign');
            $table->string('file');
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
