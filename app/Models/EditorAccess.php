<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'editor_1',
        'editor_2',
        'note',
    ];

}