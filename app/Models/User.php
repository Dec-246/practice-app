<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]

/**
 * @property-read Collection<int, Idea> $ideas
 */

class User extends Authenticatable
{
    /** @use HasFactory<Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable
      * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialisation
     * @var list<string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // getting ideas from user
    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    // determining if admin is an admin
    // setting admin role based on ID
    public function isAdmin(): bool
    {
        return $this->id == 2; //test@gmail.com has admin perms
        // test@gmail.com
        // Testing123!
    }
}
