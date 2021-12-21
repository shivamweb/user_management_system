<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id'; 

    protected $fillable = ['records_id','title'];

    public function post_photo(){
        return $this->morphMany(photo::class,'imageable');
    }

    public function user(){
        return $this->belongsTo(records::class,'records_id', 'id');
    }
}
