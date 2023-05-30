<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersdetails', function (Blueprint $table) {
            $table->id();
            $table->uuid('driver_license_id')->nullable();
            $table->string('refrence_id')->nullable();
            $table->string('metadata')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('zip_code');
            $table->string('city_name');
            $table->string('state_name');
            $table->integer('height');
            $table->text('allergies');
            $table->boolean('pregnancy');
            $table->text('current_medications');
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
        Schema::dropIfExists('usersdetails');
    }
}
