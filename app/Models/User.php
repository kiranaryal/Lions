<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;



class User extends Authenticatable implements MustVerifyEmail,FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $fillable = [
        'name',
        'phone',
        'lion_id',
        'email',
        'password',
        'is_admin'
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = [
        'profile_photo_url',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user)
        {
            $user->profile()->create([
                'full_name'=>$user->username,
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function businessProfile()
    {
        return $this->hasMany(BusinessProfile::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin && $this->hasVerifiedEmail();
    }

}
