<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'patient_order_details';

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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function OrderStatus()
    {
        return $this->hasOne('App\Models\OrderStatus', 'order_id')->orderBy('created_at', 'DESC');
    }

    public function MedicineDetail()
    {
        return $this->hasOne('App\Models\MedicineDetail', 'id', 'medication_id');
    }

    public function PrescriptionDetail()
    {
        return $this->hasOne('App\Models\PrescriptionDetail', 'id', 'prescription_id');
    }
}
