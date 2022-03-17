<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = [
        'theme',
        'field',
        'status',
        'pathFile',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
