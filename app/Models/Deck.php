<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $table = 'decks';
    
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'description',
        'img',
        'public',
        'format_id',
        'user_id',
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function format() {
        return $this->belongsTo(Format::class);
    }

    public function cards() {
        return $this->hasMany(Card::class, 'cards_deck');
    }
}
