<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_login_History extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'status'];

    public function user_record()
    {
        return $this->belongsTo(records::class, 'user_id', 'id');
    }
}
