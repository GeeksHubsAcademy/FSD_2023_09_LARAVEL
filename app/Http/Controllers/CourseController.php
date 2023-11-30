<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function getCourseByIdWithUserCreator(Request $request, $id) {
        try {
            $course = Course::query()->find($id);

            // TODO handled error course not exists
            // if(!$course) {

            // }

            $course->user;

            return response()->json(
                [
                    "success" => true,
                    "message" => "get courses with creator",
                    "data" => $course
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting courses with creator"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
