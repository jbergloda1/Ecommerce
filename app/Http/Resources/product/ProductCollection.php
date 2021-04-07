<?php

namespace App\Http\Resources\product;
use App\Http\Resources\BaseCollection;

class ProductCollection extends BaseCollection
{
    public function toArray($request)
    {
        return $this->map(function ($product) {
            return [
                'id'            => $product->id,
                'name'          => $product->name,
                //'amount'        => $product->amount,
                'img'           => $product->img,
                'note'          => $product->note,
                'import_price'  => $product->import_price,
                'export_price'  => $product->export_price,
                'sale'          => $product->sale,
                'status'        => $product->status,
                'supplier_id'   => $product->supplier_id,
                'created_at'    => $product->created_at,
                'updated_at'    => $product->updated_at,
            ];
        });
    }
}
