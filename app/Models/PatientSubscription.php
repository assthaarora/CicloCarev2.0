<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSubscription extends Model
{
    use HasFactory;

    protected $table = 'patient_subscription';

    protected $fillable = [
        'userId','mId','caseId','subscription','created_by', 'created_at' 
    ];
}