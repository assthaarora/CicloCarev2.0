<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'doc_name',
        'doc_type',
    ];
}
