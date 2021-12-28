<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class records extends  Authenticatable
{ 
    use Notifiable;
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guard = 'web';

    protected $fillable = [
        'name', 
        'age', 
        'contact', 
        'email', 
        'password', 
        'image_path',
        'social_id',
        'social_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function user_history()
    {
        return $this->hasMany(User_login_History::class, 'user_id', 'id');
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNameAttribute($value)
    {
       $this->attributes['name'] = strtolower($value);
    }

    public function user_post()
    {
        return $this->hasMany(Post::class,'records_id','id');
    }
}
