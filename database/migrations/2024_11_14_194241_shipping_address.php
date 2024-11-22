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
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->id();
            $table->string('subdistrict');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('urban_village', function (Blueprint $table) {
            $table->id();
            $table->string('urban_village');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("subdistrict_id")->references("id")->on("subdistrict")->onDelete("cascade");
        });
        Schema::create('street', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("urban_village_id")->references("id")->on("urban_village")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subdistrict');
        Schema::dropIfExists('urban_village');
        Schema::dropIfExists('street');
    }
};
