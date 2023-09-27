<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Kit\KitCollection;
use App\Http\Resources\Kit\KitResource;
use App\Models\Kit;
use App\Repositories\KitRepository;
use Illuminate\Http\Request;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return KitCollection
     */
    public function index(): KitCollection
    {
        return new KitCollection(KitRepository::getAll());
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
     * @param  Kit  $kit
     * @return KitResource
     */
    public function show(Kit $kit): KitResource
    {
        return new KitResource($kit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kit $kit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kit $kit)
    {
        //
    }
}
