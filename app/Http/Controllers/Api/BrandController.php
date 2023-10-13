<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandCreateRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;
use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    protected BrandService $brandService;

    /**
     * @param  BrandService  $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return BrandCollection
     */
    public function index(): BrandCollection
    {
        return new BrandCollection(BrandRepository::getAll());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandCreateRequest  $request
     * @return Response
     */
    public function store(BrandCreateRequest $request): Response
    {
        $this->brandService->store($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  Brand  $brand
     * @return BrandResource
     */
    public function show(Brand $brand): BrandResource
    {
        return new BrandResource($brand);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, Brand $brand): Response
    {
        $this->brandService->update($brand, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): Response
    {
        $this->brandService->destroy($brand);

        return response()->noContent();
    }
}
