<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    protected $casts = [
        'created_at' => 'datetime:d M',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function faces()
    {
        return $this->hasMany(Face::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, (new Face())->getTable())
            ->withPivot('image', 'coordinate', 'encoding')
            ->withTimestamps();
    }
}
