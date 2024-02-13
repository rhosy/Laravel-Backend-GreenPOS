<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
        'phone',
        'role',
        'merchant_id',
        'outlet_id',
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

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function getOutlets()
    {
        if ($this->outlet_id != null) {
            $outlets = Outlet::with('province')->where('id', $this->outlet_id)->get();
        } else {
            $outlets = Outlet::with('province')->where('merchant_id', $this->merchant_id)->get();
        }

        return $outlets;
    }
}
