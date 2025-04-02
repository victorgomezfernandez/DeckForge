<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    use HasFactory;

    protected $table = 'legalities';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'card_id',
        'format_id',
        'name',
        'status',
    ];

    public $timestamps = true;

    public function card() {
        return $this->belongsTo(Card::class);
    }

    public function format() {
        return $this->belongsTo(Format::class);
    }
}
