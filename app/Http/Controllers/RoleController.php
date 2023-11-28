<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request) {
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
