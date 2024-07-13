<?php

namespace App\Services;

use App\Models\Klass;
use Illuminate\Http\Request;

class KlassService
{
    public function addStudyPlan(Klass $klass, Request $request)
    {
        $klass = Klass::findOrFail($klass->id);

        $lectures = $request->input('lectures', []);

        $syncResult = $klass->lectures()->syncWithoutDetaching($lectures);

        $newLectures = $syncResult['attached'];
        $existingLectures = $syncResult['updated'];

        $response = [
            'message' => 'Лекции обновлены успешно.',
            'newlyAddedLectures' => $newLectures,
            'existingLectures' => $existingLectures,
            'klass' => $klass->load('lectures')
        ];

        if (count($newLectures) > 0) {
            $response['message'] = 'Новые лекции добавлены успешно.';
        } else {
            $response['message'] = 'Новые лекции не были добавлены, так как все выбранные лекции уже присутствуют в учебном плане.';
        }

        return $response;
    }

    public function updateStudyPlan(Klass $klass, Request $request)
    {
        $lecturesOrder = $request->input('lectures', []);

        $syncData = [];

        foreach ($lecturesOrder as $lecture) {
            $syncData[$lecture['id']] = ['order' => $lecture['order']];
        }

        $klass->lectures()->sync($syncData);

        return [
            'message' => 'Учебный план обновлен',
            'klass' => $klass->load('lectures')
        ];
    }

}