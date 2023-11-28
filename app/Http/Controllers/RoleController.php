<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function createRole(Request $request) {
        Log::info('Create Role');
        try {
            $name = $request->input('name');

            // // query builder
            // DB::table('roles')->insert(
            //     [
            //         'name' => $name,
            //         // 'created_at' ...
            //     ]
            // );

            // $newRole = new Role();

            // // $newRole->name = $request->name;
            // // $newRole->name = $request->input('name');
            // $newRole->name = $name;

            // $newRole->save();

            $newRole = Role::create([
                'name' => $name,
            ]);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Role created",
                    "data" => $newRole
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating role"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }


        return 'Create Role';
    }

    public function getAllRoles(Request $request) {
        try {
            $roles = Role::query()->get();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Roles retrieving",
                    "data" => $roles
                ],
                Response::HTTP_OK
            );



        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error retrieving roles"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateRoleById(Request $request, $id) {
        return 'Update roles by id: '.$id;
    }

    public function deleteRoleById(Request $request, $id) {
        return 'Delete role by id: '.$id;
    }
}
