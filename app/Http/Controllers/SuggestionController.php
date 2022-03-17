<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    //
    function getAllSuggestions()
    {
        return Suggestion::all();
    }
    
    function createSuggestion(Request $request, $id)
    {
        $suggest = new Suggestion;
        $suggest->user_id = $id;
        $suggest->message = $request->message;
        $result = $suggest->save();
        if($result)
        {
            return $suggest;
        }
        else
        {
            return response(
                ["message" => "An error occured"]
            );
        }
    }

    function deleteSuggestion($id)
    {
        $suggest = Suggestion::find($id);
        $result = $suggest->delete();
        if($result)
        {
            return response(
                ['message' => "OK"]
            );
        }
        else
        {
            return response(
                ['message' => 'An error occurs']
            );
        }
    }
}
