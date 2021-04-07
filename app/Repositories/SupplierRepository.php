<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\UserUnauthorizedException;
use Config;

class SupplierRepository
{
    public function search($inputs)
    {
        return Supplier::with('category')
        ->when(isset($inputs['id']), function ($query) use ($inputs) {
            return $query->where('id', $inputs['id']);
        })
        ->when(isset($inputs['status']), function ($query) use ($inputs) {
            return $query->where('status', $inputs['status']);
        })
        ->when(isset($inputs['name']), function ($query) use ($inputs) {
            return $query->where('name', 'LIKE', '%' . $inputs['name'] . '%');
        })
        ->orderBy('name', 'desc')
        ->paginate(10);
    }

    public function store($inputs)
    {
        return Supplier::create($inputs);
    }

    public function show($id)
    {
        return Supplier::findOrFail($id);
    }

    public function update($inputs, $id)
    {
        return Supplier::findOrFail($id)
            ->update($inputs);
    }
}
