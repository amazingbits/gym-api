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
        Schema::create('tbl_checkin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("gym_id");
            $table->unsignedBigInteger("customer_id");
            $table->foreign("gym_id")->references("id")->on("tbl_gym");
            $table->foreign("customer_id")->references("id")->on("tbl_customer");
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
        Schema::dropIfExists('tbl_checkin');
    }
};
