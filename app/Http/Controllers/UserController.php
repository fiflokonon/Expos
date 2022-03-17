<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // function login(Request $req)

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return response([
                'message' => ['These credentials do not match our records']
            ], 404);
        }

        $token = $user->createToken('user-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    function signup(Request $request)
    {
        $student = new User;
        $student->matricule = $request->matricule;
        $student->lastName = $request->lastName;
        $student->firstName = $request->firstName;
        $student->sexe = $request->sexe;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->password = Hash::make($request->password);
        $student->promotion = $request->promotion;
        $student->speciality_id = $request->speciality_id;
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response ([
                "message" => "An error occured"
            ]);
        }
    }

    function getAllStudents()
    {
        return User::where('role', 'student')->get();
    }

    function addUserProfilePhoto(Request $request, $id)
    {
        $student = User::find($id);
        $student->profileImg = $request->file('file')->store('apiDocs');
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }

    function editUser(Request $request, $id)
    {
        $student = User::find($id);
        $student->matricule = $request->matricule;
        $student->lastName = $request->lastName;
        $student->firstName = $request->firstName;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->speciality_id = $request->speciality_id;
        $student->password = Hash::make($request->password);
        $student->promotion = $request->promotion;
        #$student->role = 'student';
        #$student->profileImg = '';
        $result = $student->save();
        if($result)
        {
            return $student;
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }

    }

    function changeRoleToAdmin($id)
    {
        $user = User::where('id', $id);
        $user->role = 'admin';
        $result = $user->save();
        if($result)
        {
            return response(
                ["message"=> "Role changed"]
            );
        }
        else
        {
            return response(
                ["message"=> "An error occurs"]
            );
        }
    }

    function deleteUser($id)
    {
        $student = User::find($id);
        $result = $student->delete();
        if($result)
        {
            return response(
                ["message"=>"Student removed successfully"]
            );
        }
        else
        {
            return response(
                ["message" => "An error occurs"]
            );
        }
    }

    function deletePromoStudents($promo)
    {
        $students = User::where('promotion', $promo)->where('role', 'student')->get();
        if(sizeof($students) != 0 )
        {
            for($i=0; $i< sizeof($students); $i++)
            {
                $students[$i]->delete();
            }
        }
    }

    function getStudentsByPromo($promo)
    {
        return User::where('promotion', $promo)->where('role', 'student')->get();
    }

    function getStudentsBySpeciality($id)
    {
        return User::where('speciality_id', $id)->where('role', 'student')->get();
    }
}
