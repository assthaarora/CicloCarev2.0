<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoremedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storemedications', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_medication_id')->nullable();
            $table->string('no_of_days')->nullable();
            $table->string('dosespot_rxcui')->nullable();
            $table->string('active')->nullable();
            $table->string('ndc')->nullable();
            $table->string('days_supply')->nullable();
            $table->string('refills')->nullable();
            $table->string('name')->nullable();
            $table->string('pharmacy_notes')->nullable();
            $table->string('directions')->nullable();
            $table->string('quantity')->nullable();
            $table->string('dispense_unit')->nullable();
            $table->string('strength')->nullable();
            $table->string('dispense_unit_id')->nullable();
            $table->string('pharmacy_id')->nullable();
            $table->string('pharmacy_name')->nullable();
            $table->string('metadata')->nullable();
            $table->string('thank_you_note')->nullable();
            $table->string('clinical_note')->nullable();
            $table->string('allow_substitutions')->nullable();
            $table->string('title')->nullable();
            $table->string('effective_date')->nullable();
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
        Schema::dropIfExists('storemedications');
    }
}
