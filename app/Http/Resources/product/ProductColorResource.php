<?php

namespace App\Http\Resources\product;
use App\Http\Resources\BaseResource;

class ProductColorResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'color'         => $this->color,
            'product_id'    => $this->product_id,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
