<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 511);
            $table->string('description');
            $table->float('prix', 15, 2);
            $table->text('image');
            $table->integer('stock');
            $table->string('hauteur', 15);
            $table->string('largeur', 15);
            $table->string('longueur', 15);
            $table->string('usage', 255);
            $table->unsignedBigInteger('id_materiau');
            $table->unsignedBigInteger('id_marque');
            $table->unsignedBigInteger('id_categorie');

            $table
                ->foreign('id_materiau')
                ->references('code')
                ->on('materiaux');

            $table
                ->foreign('id_marque')
                ->references('code')
                ->on('marques');

            $table
                ->foreign('id_categorie')
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
        Schema::dropIfExists('produits');
    }
}
