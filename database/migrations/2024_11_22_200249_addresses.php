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

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('id_district');
            $table->string('id_village');
            $table->string('street');
            $table->unsignedBigInteger('cost_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("cost_id")->references("id")->on("costs")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
