<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @group Role Management
 *
 * APIs to manage the role ressource
 */

class RoleController extends Controller
{
    //
    /**
     * Get all the roles
     * @authentificated
     */
    function getRoles()
    {
        return Role::all();
    }

    /**
     * Get a role by his ID
     * @authentificated
     * 
     * @urlParam id integer required The ID of the role.
     */
    function getRole($id)
    {
        return Role::where('id', $id)->get();
    }

    /** 
     * Create a role.
     * @authentificated
     * 
     * @queryParam role object required and the role details
     * @queryParam role.name string required
     */
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

    /**
     * Edit a role with it ID
     * @authentificated
     * 
     * @urlParam id integer required The ID of the role.
     * @queryParam role object and role details
     */
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

    /**
     * Delete a role by it ID
     * @authentificated
     * 
     * @urlParam id integer required The ID of the role.
     */
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
