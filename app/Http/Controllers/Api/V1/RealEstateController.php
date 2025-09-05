<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealEstateCollectionResource; // <-- Import
use App\Http\Resources\RealEstateResource;           // <-- Import
use App\Models\RealEstate;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use the "List" resource for the collection
        return RealEstateCollectionResource::collection(RealEstate::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // We will implement this after validation
    }

    /**
     * Display the specified resource.
     */
    public function show(RealEstate $realEstate)
    {
        // Use the "Full Detail" resource for a single item
        return new RealEstateResource($realEstate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RealEstate $realEstate)
    {
        // We will implement this after validation
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RealEstate $realEstate)
    {
        // We will implement this after soft-deletes
    }
}