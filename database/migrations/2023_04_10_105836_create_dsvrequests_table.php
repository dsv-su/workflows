<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsvrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsvrequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('id')->on('users');
            $table->unsignedBigInteger('requestid');
            $table->foreign('requestid')->references('id')->on('travel_requests');
            $table->string('type');
            $table->unsignedBigInteger('projectleader');
            $table->foreign('projectleader')->references('id')->on('users');
            $table->unsignedBigInteger('unithead');
            $table->foreign('unithead')->references('id')->on('users');
            $table->integer('pl_status');
            $table->integer('uh_status');
            $table->string('status');
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
        Schema::dropIfExists('dsvrequests');
    }
}
