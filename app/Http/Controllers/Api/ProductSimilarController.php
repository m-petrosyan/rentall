<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSimilar\ProductSimilarRequest;
use App\Models\Product;
use App\Services\SimilarService;
use Illuminate\Http\Response;

class ProductSimilarController extends Controller
{
    protected SimilarService $similarService;

    /**
     * @param  SimilarService  $similarService
     */
    public function __construct(SimilarService $similarService)
    {
        $this->similarService = $similarService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductSimilarRequest  $request
     * @param  Product  $product
     * @return Response
     */
    public function store(ProductSimilarRequest $request, Product $product): Response
    {
        $this->similarService->store($product, $request['ids']);

        return response()->noContent();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductSimilarRequest  $request
     * @param  Product  $product
     * @return Response
     */
    public function update(ProductSimilarRequest $request, Product $product): Response
    {
        $this->similarService->update($product, $request['ids']);

        return response()->noContent();
    }
}
