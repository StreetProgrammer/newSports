<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('R_playground_owner_id');
            $table->integer('R_playground_id')->nullable();
            $table->integer('R_creator_id')->nullable();
            $table->integer('R_event_id')->nullable();
            $table->integer('code')->nullable();
            $table->date('R_date')->nullable();
            $table->integer('R_day')->nullable();
            $table->integer('R_from')->nullable();
            $table->integer('R_to')->nullable();
            $table->timestamp('R_JQueryFrom')->nullable();
            $table->timestamp('R_JQueryTo')->nullable();
            $table->integer('R_price_per_hour')->nullable();
            $table->integer('R_hour_count')->nullable();
            $table->integer('R_total_price')->nullable();
            $table->integer('R_payment_status')->nullable();
            $table->integer('clubPaid')->nullable();
            $table->string('resOwner')->nullable();
            $table->integer('reservedBy')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
