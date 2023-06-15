<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCaseStatusDetails extends Model
{
    use HasFactory;

    protected $table = 'patient_case_status';

    protected $fillable = [
        'name','reason','updated_at','caseId','userId', 'created_at' 
    ];
}
