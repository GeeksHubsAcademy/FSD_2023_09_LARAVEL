<?php

use App\Http\Controllers\RoleController;
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

Route::get('/api', function(Request $request) {
    return response()->json(
        [
            "success" => true,
            "message" => "Healthcheck ok"
        ],
        Response::HTTP_OK //code status 200
    );
});

// CRUD ROLES
Route::post('/roles', [RoleController::class, 'createRole']);
Route::get('/roles', [RoleController::class, 'getAllRoles']);
Route::put('/roles/{id}', [RoleController::class, 'updateRoleById']);
Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleById']);
