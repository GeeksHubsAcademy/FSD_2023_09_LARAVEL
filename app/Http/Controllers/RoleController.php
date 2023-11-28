<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function createRole(Request $request) {
        try {
            $name = $request->input('name');

            // query builder
            DB::table('roles')->insert(
                [
                    'name' => $name,
                    // 'created_at' ...
                ]
            );

            return response()->json(
                [
                    "success" => true,
                    "message" => "Role created"
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
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
        return 'Get All roles';
    }

    public function updateRoleById(Request $request, $id) {
        return 'Update roles by id: '.$id;
    }

    public function deleteRoleById(Request $request, $id) {
        return 'Delete role by id: '.$id;
    }
}
