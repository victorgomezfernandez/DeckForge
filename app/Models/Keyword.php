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
    ];

    public $timestamps = false;

    public function cards() {
        return $this->belongsToMany(Card::class, 'card_keywords');
    }
}
