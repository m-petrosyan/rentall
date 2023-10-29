<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kit\KitCreateRequest;
use App\Http\Requests\Kit\KitGetRequest;
use App\Http\Requests\Kit\KitUpdateRequest;
use App\Http\Resources\Kit\KitCollection;
use App\Http\Resources\Kit\KitResource;
use App\Models\Kit;
use App\Repositories\KitRepository;
use App\Services\KitService;
use Illuminate\Http\Response;

class KitController extends Controller
{
    protected KitService $kitService;

    /**
     * @param  KitService  $kitService
     */
    public function __construct(KitService $kitService)
    {
        $this->kitService = $kitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  KitGetRequest  $request
     * @return KitCollection
     */
    public function index(KitGetRequest $request): KitCollection
    {
        return new KitCollection(KitRepository::getPaginate($request->limit, $request->page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KitCreateRequest $request): Response
    {
        $this->kitService->store($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  Kit  $kit
     * @return KitResource
     */
    public function show(Kit $kit): KitResource
    {
        return new KitResource($kit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KitUpdateRequest  $request
     * @param  Kit  $kit
     * @return Response
     */
    public function update(KitUpdateRequest $request, Kit $kit): Response
    {
        $this->kitService->update($kit, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kit $kit)
    {
        $this->kitService->destroy($kit);

        return response()->noContent();
    }
}
