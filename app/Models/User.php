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
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'user_name',
        'user_email',
        'user_tlp',
        'user_photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoUrlAttribute()
    {
        $photo = $this->user_photo;
        if (!$photo) {
            return 'https://ui-avatars.com/api/?background=7048e8&color=fff&bold=true&name=' . urlencode($this->user_name ?? 'U');
        }
        return preg_match('/^https?:\/\//', $photo) ? $photo : asset($photo);
    }

    public function subAssets()
    {
        return $this->hasMany(SubAsset::class, 'sub_id_user', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'trans_id_user', 'user_id');
    }
}
