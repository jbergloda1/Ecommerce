<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize;

class Size extends Model
{
    use HasFactory;
    protected $table = 'size';
    protected $fillable = ['size', 'status'];
    public function productSize()
    {
        return $this->belongstoMany('App\Models\ProductSize');
    }
}
