<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->string('code')->unique()->nullable(false);
                $table->string('name')->nullable(false);
                $table->string('type')->nullable(false);
                $table->boolean('availability')->nullable(false);
                $table->boolean('needing_repair')->nullable(false);
                $table->integer('durability')->nullable(false);
                $table->integer('max_durability')->nullable(false);
                $table->integer('mileage')->nullable();
                $table->integer('price')->nullable(false);
                $table->tinyInteger('minimum_rent_period')->nullable(false);
                $table->timestamps();
            });
        }
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
}
