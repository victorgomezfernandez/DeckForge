<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $table = 'keywords';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;
}
