<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function faces()
    {
        return $this->throughPhotos()->hasFaces();
    }

    public function characters()
    {
        return Character::whereHas('photos', fn ($query) => $query->whereUserId($this->id));
    }

    public function getRecentPhotos()
    {
        return [
            'month' => $this->photos()->whereDate('created_at', '>', now()->subMonth())->count(),
            'week' => $this->photos()->whereDate('created_at', '>', now()->subWeek())->count(),
            'day' => $this->photos()->whereDate('created_at', '>', now()->subDay())->count(),
        ];
    }

    public function guessFace(string $face): ?Face
    {
        foreach ($this->faces as $knowingFace) {
            if ($knowingFace->compare($face)) {
                return $knowingFace;
            }
        }

        return null;
    }
}
