<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    use HasFactory;

    protected $table = 'card_details';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'power',
        'toughness',
        'loyalty',
        'defense',
        'oracle_text',
        'flavor_text',
        'card_id'
    ];

    public $timestamps = false;
    
    public function card() {
        return $this->belongsTo(Card::class);
    }
    
    public function types() {
        return $this->belongsToMany(Type::class, 'card_details_types');
    }

    public function mana_costs() {
        return $this->hasMany(ManaCost::class);
    }
}
