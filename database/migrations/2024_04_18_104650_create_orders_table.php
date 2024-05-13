<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //unsignedBigInteger for IDs
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('state');
            $table->date('date');
            $table->float('total', 15,2);


            $table
                ->foreign('id_user')
                ->references('id')
                ->on('users')
            ;

            $table
                ->foreign('state')
                ->references('id')
                ->on('orders_state')
            ;

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
        Schema::dropIfExists('orders');
    }
}
