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
        Schema::create('tbl_session', function (Blueprint $table) {
            $table->uuid("session_id")->unique()->primary();
            $table->uuid("customer_id");
            $table->string("jwt_hash");
            $table->dateTime("created_at")->default(now());
            $table->dateTime("expires_at");
            $table->foreign("customer_id")->references("customer_id")->on("tbl_customer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_session');
    }
};
