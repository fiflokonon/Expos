<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    function getRoles()
    {
        return Role::all();
    }

    function getRole($id)
    {
        return Role::where('id', $id)->get();
    }

    function createRole(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $result = $role->save();
        if($result)
        {
            return $role;
        }
        else
        {
            return response([
                "message" => "An error occurs"
            ]);
        }
    }

    function editRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $result = $role->save();
        if($result)
        {
            return $role;
        }
        else
        {
            return response([
                "message" => "An error occurs"
            ]);
        }
    }

    function deleteRole($id)
    {
        $role = Role::find($id);
        $result = $role->delete();
        if($result)
        {
            return response(
                ["message" => "OK"]
            );
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }
}
