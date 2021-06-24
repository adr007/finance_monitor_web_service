<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_assets', function (Blueprint $table) {
            $table->id('sub_id');
            $table->unsignedBigInteger('sub_id_asset');
            $table->unsignedBigInteger('sub_id_user');
            $table->string('sub_name', 100);
            $table->integer('sub_value');
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
        Schema::dropIfExists('sub_assets');
    }
}
