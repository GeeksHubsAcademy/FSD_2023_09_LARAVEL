<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function applyCourse(Request $request) {
        try {

            // Validaciones

            // // Guardamos en bd
            // DB::table('course_user')->insert(
            //     [
            //         'user_id' => auth()->user()->id,
            //         'course_id' => $request->input('course_id')
            //     ]
            // );

            $userId = auth()->user()->id;
            $courses = $request->input('courses_ids');
            
            //toDo    
            $user = User::find($userId);

            foreach ($courses as $key => $courseId) {
                $user->coursesManyToMany()->attach($courseId);
            }

            return response()->json(
                [
                    "success" => true,
                    "message" => "Apply course",
                    // "data" => $course
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error apply course"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
