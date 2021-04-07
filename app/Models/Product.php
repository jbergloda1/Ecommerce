<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductColor;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        //'amount',
        'img',
        'note',
        'import_price',
        'export_price',
        'sale',
        'status',
        'supplier_id'
    ];
    protected $guarded = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function productImage()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function productSize()
    {
        return $this->belongstoMany('App\Models\ProductSize');
    }

    public function productColor()
    {
        return $this->hasMany('App\Models\ProductColor');
    }
}
