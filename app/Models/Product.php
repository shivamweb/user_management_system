<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 

    protected $fillable = ['name'];

    public function category(){
        return $this->belongsToMany(Category::class,'category_product');
    }

    public function product_photo(){
        return $this->morphMany(photo::class,'imageable');
    }

}
