<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rent\RentCreateRequest;
use App\Http\Resources\Rent\RentCollection;
use App\Http\Resources\Rent\RentResource;
use App\Models\Rent;
use App\Repositories\RentRepository;
use App\Services\RentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentController extends Controller
{
    protected RentService $rentService;

    /**
     * @param  RentService  $rentService
     */
    public function __construct(RentService $rentService)
    {
        $this->rentService = $rentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RentCollection
     */
    public function index(): RentCollection
    {
        return new RentCollection(RentRepository::getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RentCreateRequest  $request
     * @return Response
     */
    public function store(RentCreateRequest $request): Response
    {
        $this->rentService->store($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  Rent  $rent
     * @return RentResource
     */
    public function show(Rent $rent): RentResource
    {
        return new RentResource($rent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
