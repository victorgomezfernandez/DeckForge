<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'types';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'name'
    ];

    //public array $translatable = ['name'];

    public $timestamps = false;

    public function card_details() {
        return $this->belongsToMany(CardDetails::class, 'card_details_types');
    }
}
