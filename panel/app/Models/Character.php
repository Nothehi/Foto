<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'face_id',
        'key',
        'name',
    ];

    protected $with = ['avatar'];

    public static function boot()
    {
        parent::boot();

        static::creating(fn ($character) => $character->key = str()->uuid());
    }

    public function avatar()
    {
        return $this->belongsTo(Face::class, 'face_id');
    }

    public function faces()
    {
        return $this->hasMany(Face::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class, (new Face())->getTable())
            ->withPivot('image', 'coordinate', 'encoding')
            ->withTimestamps();
    }

}
