<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManaCost extends Model
{
    use HasFactory;

    protected $table = 'mana_costs';

    protected $fillable = [
        'amount',
        'card_details_id',
        'color_id',
    ];

    public $timestamps = false;
    
    public function cardDetails() {
        return $this->belongsTo(CardDetails::class, 'card_details_id');
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }
}
