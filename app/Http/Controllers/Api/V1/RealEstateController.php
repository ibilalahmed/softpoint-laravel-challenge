<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRealEstateRequest;
use App\Http\Requests\UpdateRealEstateRequest; 
use App\Http\Resources\RealEstateCollectionResource;
use App\Http\Resources\RealEstateResource;
use App\Models\RealEstate;
use Illuminate\Http\Response;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RealEstateCollectionResource::collection(RealEstate::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRealEstateRequest $request)
    {
        // Validation is handled automatically by StoreRealEstateRequest.
        $realEstate = RealEstate::create($request->validated());

        // Return the newly created record, using the detailed resource format.
        // Respond with 201 Created status code.
        return (new RealEstateResource($realEstate))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(RealEstate $realEstate)
    {
        return new RealEstateResource($realEstate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRealEstateRequest $request, RealEstate $realEstate)
    {
        // Validation is handled automatically by UpdateRealEstateRequest.
        $realEstate->update($request->validated());

        // Return the newly updated record, as per the challenge requirement.
        return new RealEstateResource($realEstate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RealEstate $realEstate)
    {
        // This performs a soft delete because of the SoftDeletes trait on the model.
        $realEstate->delete();

        // Return the recently removed record, as per the challenge requirement.
        return new RealEstateResource($realEstate);
    }
}