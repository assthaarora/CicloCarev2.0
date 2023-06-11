<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUpload extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'doc_id',
        'name',
        'file_path',
        'created_at',
        'updated_at',
        'filename',
        'user_id',
        'mime',
        'file_size',
        'uploaded_file',
        'created_by',
        'updated_by',
        'mdi_fileId',
        'mdi_url',
        'mdi_urlThumbnail'
    ];
}
