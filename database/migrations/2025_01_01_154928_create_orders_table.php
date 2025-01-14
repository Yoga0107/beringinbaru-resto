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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('street_id');
            $table->decimal('total', 8, 2);
            $table->boolean('paid')->default(0);
            $table->boolean('delivery')->default(0);
            $table->boolean('cod')->default(0);
            $table->string('receipt')->nullable();
            $table->string('status');
            $table->string('courier')->nullable();
            $table->time('estimation')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("street_id")->references("id")->on("streets")->onDelete("cascade");
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
};
