<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntakeformAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intakeform_answer', function (Blueprint $table) {
            $table->id();
            $table->string('questionnaire_id');
            $table->string('patient_id');
            $table->string('partner_id');
            $table->string('type');
            $table->json('answer')->nullable();
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
        Schema::dropIfExists('intakeform_answer');
    }
}
