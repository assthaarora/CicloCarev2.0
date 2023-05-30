<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDetail extends Model
{
    use HasFactory;

    protected $table = 'medicinedetails';

    protected $fillable = [
        'id', 'med_name', 'med_Desc', 'subscription', 'subscription_frequency', 'subscription_duration', '`active_ingredient(s)`', 'quantity', 'price', 'refills', 'dispense_unit', 'directions', 'userId', 'created_by', 'created_at', 'updated_by', 'updated_at', 'intakeformId',
    ];

    public function IntakeFormAnswer()
    {
        return $this->hasOne('App\Models\IntakeFormAnswer', 'id', 'intakeformId');
    }
}
