<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get(
//     '/user',
//     function (Request $request) {
//         return $request->user();
//     }
// );

Route::get('/api', function (Request $request) {
    return response()->json(
        [
            "success" => true,
            "message" => "Healthcheck ok"
        ],
        Response::HTTP_OK //code status 200
    );
});

// CRUD ROLES
Route::group([
    'middleware' => ['auth:sanctum', 'is_super_admin']
], function () {
    Route::post('/roles', [RoleController::class, 'createRole']);
    Route::get('/roles', [RoleController::class, 'getAllRoles']);
    Route::put('/roles/{id}', [RoleController::class, 'updateRoleById']);
    Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleById']);
});

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => ['auth:sanctum', 'ejemplo']
], function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// SUPER_ADMIN ROUTES
Route::group([
    'middleware' => [
        'auth:sanctum',
        'is_super_admin'
    ]
], function () {
    Route::get('/users', [UserController::class, 'getAllUsers']);
});

// SUPER_ADMIN ROUTES
Route::group([
    'middleware' => [
        'auth:sanctum',
        'is_super_admin'
    ]
], function () {
    Route::get('/courses/{id}', [CourseController::class, 'getCourseByIdWithUserCreator']);
    Route::get('/users/{id}', [UserController::class, 'getUserByIdWithCreateCourses']);
});


