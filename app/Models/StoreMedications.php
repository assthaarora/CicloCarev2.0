<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMedications extends Model
{
    use HasFactory;
    protected $table = 'storemedications';

    protected $fillable = [
        'patient_id',
        'partner_id',
        'partner_medication_id',
        'dosespot_rxcui',
        'active',
        'ndc',
        'days_supply',
        'refills',
        'name',
        'pharmacy_notes',
        'directions',
        'quantity',
        'dispense_unit',
        'strength',
        'dispense_unit_id',
        'pharmacy_id',
        'pharmacy_name',
        'metadata',
        'thank_you_note',
        'clinical_note',
        'allow_substitutions',
        'title',
        'effective_date',
        'created_at',
        'updated_at'
    ];
}
