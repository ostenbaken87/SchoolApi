<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKlassRequest;
use App\Http\Requests\UpdateKlassRequest;
use App\Models\Klass;
use App\Http\Resources\V1\KlassResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class KlassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return KlassResource::collection(Klass::with('students', 'lectures')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKlassRequest $request): JsonResource
    {
        return new KlassResource(Klass::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResource
    {
        return new KlassResource(Klass::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKlassRequest $request, Klass $klass): JsonResource
    {
        $klass->update($request->validated());
        return new KlassResource($klass);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klass $klass):JsonResponse
    {
        return response()->json($klass->delete(), 204);
    }
}
