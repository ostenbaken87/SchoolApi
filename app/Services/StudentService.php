<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentService
{
    public function addLectures(Student $student, Request $request)
    {
        $student = Student::findOrFail($student->id);

        $lectures = $request->input('lectures', []);
        $syncResult = $student->lectures()->syncWithoutDetaching($lectures);

        $newLectures = $syncResult['attached'];

        return [
            'message' => 'Lectures added successfully',
            'newlyAddedLectures' => $newLectures,
            'student' => $student->load('lectures')
        ];
    }
}