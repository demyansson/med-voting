<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting_options', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('voting_id');

            $table->foreign('voting_id')
                ->references('id')->on('votings')
                ->onDelete('cascade');

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
        Schema::dropIfExists('voting_options');
    }
}
