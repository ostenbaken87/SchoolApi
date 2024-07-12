<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\V1\StudentResource;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return StudentResource::collection(Student::with('klass')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        return new StudentResource(Student::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): JsonResource
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResource
    {
        $student->update($request->validated());
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        return response()->json($student->delete(), 204);
    }

    public function addLectures(Student $student, Request $request)
    {
        $student = Student::findOrFail($student->id);

        $lectures = $request->input('lectures',[]);
        $student->lectures()->syncWithoutDetaching($lectures);

        return response()->json([
            'message' => 'Lectures added successfully',
            'student' => $student->load('lectures')
        ], 200);
    }
}
