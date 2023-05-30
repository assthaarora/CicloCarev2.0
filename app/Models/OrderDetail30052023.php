<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $fillable = [
        'patient_id',
        'external_patient_id',
        'businessman_id',
        'external_businessman_id',
        'prescription_id',
        'external_prescription_id',
        'medication_id',
        'external_medication_id',
        'subscription_id',
        'external_subscription_id',
        'created_at',
        'updated_at',
    ];
}
