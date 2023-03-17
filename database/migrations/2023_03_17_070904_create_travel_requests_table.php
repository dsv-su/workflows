<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('created');
            $table->string('user');
            $table->string('purpose');
            $table->boolean('paper')->default(false);
            $table->string('contribution')->nullable();
            $table->string('other')->nullable();
            $table->integer('departure');
            $table->integer('return');
            $table->integer('total');
            $table->string('project');
            $table->integer('projectleader')->default(0);
            $table->integer('unithead')->default(0);
            $table->string('status');
            $table->integer('approved');
            $table->integer('departmenthead')->default(0);
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
        Schema::dropIfExists('travel_requests');
    }
}
