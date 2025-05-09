<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $table = 'sets';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'release_date',
    ];

    public $timestamps = false;

    public function cards() {
        return $this->hasMany(Card::class);
    }

}
