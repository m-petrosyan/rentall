<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    protected CategoryService $categoryService;

    /**
     * @param  CategoryService  $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CategoryCollection
     */
    public function index(): CategoryCollection
    {
        return new CategoryCollection(CategoryRepository::getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest  $request
     * @return Response
     */
    public function store(CategoryCreateRequest $request): Response
    {
        $this->categoryService->store($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  Category  $category
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, Category $category): Response
    {
        $this->categoryService->update($category, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $this->categoryService->destroy($category);

        return response()->noContent();
    }
}
