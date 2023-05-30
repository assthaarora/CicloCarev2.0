<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicationDetail extends Model
{
    use HasFactory;
    protected $table = 'prescription_medication_details';

    protected $fillable = [
        'prescription_id',
        'dosespot_medication_id',
        'dispense_unit_id',
        'dose_form',
        'route',
        'strength',
        'generic_product_name',
        'lexi_gen_product_id',
        'lexi_drug_syn_id',
        'lexi_synonym_type_id',
        'lexi_gen_drug_id',
        'rx_cui',
        'otc',
        'ndc',
        'schedule',
        'display_name',
        'monograph_path',
        'drug_classification',
        'state_schedules',
        'metadata',
        'partner_medication_id',
        'created_at',
        'updated_at',
    ];
}
