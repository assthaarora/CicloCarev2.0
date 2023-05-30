<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeFormAnswer extends Model
{
  
    use HasFactory;
    protected $table = 'intakeform_answer';

    protected $fillable = [
        'patient_id',
        'partner_id',
        'questionnaire_id',
        'type',
        'answer',
        'title',
        'description',
        'label',
        'placeholder',
        'is_important',
        'is_critical',
        'is_optional',
        'is_visible',
        'order',
        'default_value',
        'created_at',
        'updated_at'
    ];
}
