<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $guarded = ["id"]; 
    protected $primarykey = ["id"];


    public function getCategory(){
        return $this->belongsTo(category::class, 'category_id');
    }
}