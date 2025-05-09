<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'collector_number',
        'rarity',
        'img',
        'art_crop',
        'layout',
        'mana_value',
        'released_at',
        'set_id'
    ];

    public $timestamps = false;

    public function set() {
        return $this->belongsTo(Set::class);
    }

    public function decks() {
        return $this->belongsToMany(Deck::class, 'cards_deck');
    }

    public function keywords() {
        return $this->belongsToMany(Keyword::class, 'card_keywords');
    }
    
    public function colors() {
        return $this->belongsToMany(Color::class, 'card_deck_colors');
    }

    public function color_identities() {
        return $this->belongsToMany(Color::class, 'color_identities');
    }
}
