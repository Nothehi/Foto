<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
    ];

    protected $with = ['avatar'];

    public static function boot()
    {
        parent::boot();

        static::creating(fn ($character) => $character->key = str()->uuid());
    }

}
