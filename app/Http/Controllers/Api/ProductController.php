<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductGetRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductEditResource;
use App\Http\Resources\Product\ProductOptionsResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected ProductService $productService;

    /**
     * @param  ProductService  $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param  ProductGetRequest  $request
     * @return ProductCollection
     */
    public function index(ProductGetRequest $request): ProductCollection
    {
        return new ProductCollection(
            ProductRepository::getWithPaginate($request->limit, $request->page, $request->search, $request->category)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductCreateRequest  $request
     * @return Response
     */
    public function store(ProductCreateRequest $request): Response
    {
        $this->productService->store($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return ProductResource
     */
    public function edit(Product $product): ProductResource
    {
        return new ProductResource($product);
    }


    /**
     * @param  Request  $request
     * @return ProductOptionsResource
     */
    public function options(Request $request): ProductOptionsResource
    {
        return new ProductOptionsResource($request);
    }


    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest  $request
     * @param  Product  $product
     * @return Response
     */
    public function update(ProductUpdateRequest $request, Product $product): Response
    {
        $this->productService->update($product, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $this->productService->destroy($product);

        return response()->noContent();
    }
}
