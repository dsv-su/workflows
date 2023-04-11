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
            $table->string('name');
            $table->string('purpose');
            $table->string('project');
            $table->string('country');
            $table->boolean('paper')->default(false);
            $table->string('contribution')->nullable();
            $table->string('other')->nullable();
            $table->integer('departure');
            $table->integer('return');
            $table->integer('days')->nullable();
            $table->integer('flight')->nullable();
            $table->integer('hotel')->nullable();
            $table->integer('daily')->nullable();
            $table->integer('conference')->nullable();
            $table->integer('other_costs')->nullable();
            $table->integer('total');
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
