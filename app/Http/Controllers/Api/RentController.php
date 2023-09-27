<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rent\RentCollection;
use App\Http\Resources\Rent\RentResource;
use App\Models\Rent;
use App\Repositories\RentRepository;
use Illuminate\Http\Request;

class RentController extends Controller
{
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
     */
    public function store(Request $request)
    {
        //
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
