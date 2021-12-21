<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 

    protected $fillable = ['image','imageable_id','imageable_type'];

    public function imageable(){
        return $this->morphTo();
    }
}
