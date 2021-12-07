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

    protected $fillable = ['name', 'age', 'contact', 'email', 'password', 'image_path'];

    public function user_hostory()
    {
        return $this->hasMany('App\User_login_History');
    }
}
