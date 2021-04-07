<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\category\CategoryCollection;
use App\Repositories\CategoryRepository;
use App\Http\Resources\category\CategoryResource;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function search(CategoryRequest $request)
    {
        return new CategoryCollection($this->categoryRepository->search($request->searchFilter()));
    }

    public function store(CategoryRequest $request)
    {
        return new CategoryResource($this->categoryRepository->store($request->storeFilter()));
    }

    public function show($id)
    {
        return new CategoryResource($this->categoryRepository->show($id));
    }

    public function update(CategoryRequest $request, $id)
    {
        return new CategoryResource($this->categoryRepository->update($request->updateFilter(), $id));
    }
}

