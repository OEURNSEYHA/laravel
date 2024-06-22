<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    
    use HasFactory;
    protected $table = "category";
    protected $guarded = ["id"]; 
    protected $primarykey = ["id"];
    
    public function getAllCategory(){
        return $this-> hasMany(Product::class, 'category_id ');
    }

    
}