<?php

namespace App\Http\Resources\category;
use App\Http\Resources\BaseCollection;

class CategoryCollection extends BaseCollection
{
    public function toArray($request)
    {
        return $this->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'status' => $category->status,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });
    }
}
