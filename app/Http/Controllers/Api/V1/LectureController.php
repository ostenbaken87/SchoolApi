<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Lecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Http\Resources\V1\LectureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return LectureResource::collection(Lecture::with('students', 'klass')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLectureRequest $request): JsonResource
    {
        return new LectureResource(Lecture::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture): JsonResource
    {
        return new LectureResource($lecture);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLectureRequest $request, Lecture $lecture): JsonResource
    {
        $lecture->update($request->validated());
        
        return new LectureResource($lecture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
