<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'code'
    ];

    public function cards() {
        return $this->belongsToMany(Card::class, 'card_colors');
    }

    public function decks() {
        return $this->belongsToMany(Deck::class, 'deck_colors');
    }

    public function color_identities() {
        return $this->belongsToMany(Card::class, 'color_identities');
    }

    public $timestamps = false;
}
