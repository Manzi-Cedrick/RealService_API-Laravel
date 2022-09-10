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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->text('Firstname');
            $table->text('Lastname');
            $table->integer('ProductID');
            $table->integer('Cash_Paid_Frw');
            $table->string('Status_Payment');
            $table->integer('Quantity_Paid_For');
            $table->longText('Description_Work');
            $table->foreign('ProductID')->references('id')->on('products');
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
        Schema::dropIfExists('clients');
    }
};
