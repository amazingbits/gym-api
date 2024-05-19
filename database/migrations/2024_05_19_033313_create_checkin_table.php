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
            $table->uuid("checkin_id")->unique()->primary();
            $table->uuid("gym_id");
            $table->uuid("customer_id");
            $table->foreign("gym_id")->references("gym_id")->on("tbl_gym");
            $table->foreign("customer_id")->references("customer_id")->on("tbl_customer");
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
