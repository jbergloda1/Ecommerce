<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'status'];
    protected $guarded = ['created_at', 'updated_at'];
    public    $timestamps = true;
    // public function producttypes()
    // {
    //     return $this->hasMany('App\ProductType');
    // }
}
