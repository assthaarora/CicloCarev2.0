<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    use HasFactory;
    protected $table = 'patient_prescription_details';

    protected $fillable = [
        'case_id',
        'dosespot_prescription_id',
        'refills',
        'quantity',
        'days_supply',
        'directions',
        'dosespot_prescription_sync_status',
        'dosespot_sent_pharmacy_sync_status',
        'no_substitutions',
        'pharmacy_notes',
        'dosespot_confirmation_status',
        'dosespot_confirmation_status_details',
        'thank_you_note',
        'clinical_note',
        'dispense_unit_id',
        'pharmacy_id',
        'partner_compound',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
