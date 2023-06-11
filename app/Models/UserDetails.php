<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'usersdetails';
    protected $fillable = [
        'metadata',
        'address1',
        'address2',
        'zip_code',
        'city_name',
        'state_name',
        'weight',
        'height',
        'allergies',
        'pregnancy',
        'current_medications',
        'driver_license_id',
        'userId','mdi_patientId','bmi'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  
}
