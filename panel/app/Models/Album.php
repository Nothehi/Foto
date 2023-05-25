<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $withCount = [
        'photos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class)
            ->withTimestamps();
    }

    public function characters()
    {
        return Character::whereHas('photos', function ($query) {
            $query->whereHas('albums', fn ($subQuery) => $subQuery->whereId($this->id));
        });
    }
}
