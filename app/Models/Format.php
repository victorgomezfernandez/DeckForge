<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $table = 'formats';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    
    public function decks() {
        return $this->hasMany(Deck::class);
    }
}
