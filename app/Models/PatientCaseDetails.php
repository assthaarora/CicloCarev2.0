<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCaseDetails extends Model
{
    use HasFactory;

    protected $table = 'patient_case';

    protected $fillable = [
        'prioritized_at','prioritized_reason','metadata','created_at','is_sync','is_chargeable','case_type','case_id','reference_case_id','userId','created_by','updated_by','updated_at','case_status_id',
           
    ];
}
