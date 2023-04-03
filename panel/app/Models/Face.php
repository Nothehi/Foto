<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Process;

class Face extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'character_id',
        'image',
        'coordinate',
        'encoding',
    ];

    protected $casts = [
        'coordinate' => 'array',
        'encoding' => 'array',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function compare(string $face): bool
    {
        $similarity = Process::path(base_path('../vision'))
            ->run(['./main.py', 'compare', "../storage/{$face}", "../storage/{$this->image}"])
            ->output();

        return trim($similarity) == 'True';
    }
}
