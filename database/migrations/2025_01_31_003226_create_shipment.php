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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('street_id');
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->string('address')->nullable();
            $table->boolean('delivery')->default(0);
            $table->time('estimation')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
            $table->foreign("street_id")->references("id")->on("streets")->onDelete("cascade");
            $table->foreign("courier_id")->references("id")->on("couriers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};
