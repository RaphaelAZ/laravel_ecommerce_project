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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 511);
            $table->text('description');
            $table->float('price', 15, 2);
            $table->text('image');
            $table->integer('stock');
            $table->string('height', 15);
            $table->string('width', 15);
            $table->string('length', 15);
            $table->string('usage', 255);
            $table->unsignedBigInteger('id_material');
            $table->unsignedBigInteger('id_brand');
            $table->unsignedBigInteger('id_category');

            $table
                ->foreign('id_material')
                ->references('code')
                ->on('materials');

            $table
                ->foreign('id_brand')
                ->references('code')
                ->on('brands');

            $table
                ->foreign('id_category')
                ->references('id')
                ->on('categories');

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
}
