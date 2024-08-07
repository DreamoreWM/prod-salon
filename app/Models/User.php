<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
        'role',
        'google_token',
        'google_refresh_token',
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
        'password' => 'hashed',
    ];

    public function refreshTokenIfNeeded($client)
    {

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($this->google_refresh_token);
            $newAccessToken = $client->getAccessToken();
            $this->update([
                'google_token' => $newAccessToken['access_token'],
            ]);
        }
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")->orWhere('email','like',"%{$value}%");
    }

    public function getAppointments()
    {
        return $this->appointments()->get();
    }

    // Dans User.php et TemporaryUser.php
    public function appointments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Appointment::class, 'bookable');
    }
    /**
     * Get the identifier that will be stored in the JWT subject claim.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function loyaltyCards()
    {
        return $this->hasMany(LoyaltyCard::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role; // Supposons que le rôle est stocké dans la colonne 'role'
    }


}
