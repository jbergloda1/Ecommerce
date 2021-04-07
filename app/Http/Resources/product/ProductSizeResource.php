<?php

namespace App\Http\Resources\product;
use App\Http\Resources\BaseResource;

class ProductSizeResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'product_id'    => $this->product_id,
            'size_id'       => $this->size,
            'amount'        => $this->amount,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
