<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\supplier\SupplierCollection;
use App\Repositories\SupplierRepository;
use App\Http\Resources\supplier\SupplierResource;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    private $supplierRepository;

    public function __construct(supplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function search(SupplierRequest $request)
    {
        return new SupplierCollection($this->supplierRepository->search($request->searchFilter()));
    }

    public function store(SupplierRequest $request)
    {
        return new SupplierResource($this->supplierRepository->store($request->storeFilter()));
    }

    public function show($id)
    {
        return new SupplierResource($this->supplierRepository->show($id));
    }

    public function update(SupplierRequest $request, $id)
    {
        return new SupplierResource($this->supplierRepository->update($request->updateFilter(), $id));
    }
}
