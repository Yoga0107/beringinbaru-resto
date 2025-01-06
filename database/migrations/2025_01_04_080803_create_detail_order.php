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
        Schema::create('detail_order', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('menu_id');
            $table->string('qty');
            $table->string('subtotal');
            $table->timestamps();

            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
            $table->foreign("menu_id")->references("id")->on("menus")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_order');
    }
};
