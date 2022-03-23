<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

/**
 * @group Document Management
 *
 * APIs to manage the document ressource
 */
class DocumentController extends Controller
{
    //
    function getAllDocs()
    {
        return Document::all();
    }

    function getDoc($id)
    {
        return Document::where('id', $id)->get();
    }

    function getDocsByStudent($id)
    {
        return Document::where('user_id', $id)->get();
    }

    function getDocsInactive()
    {
        return Document::where('status', false)->get();
    }

    function getDocsInactiveByStudent($id)
    {
        return Document::where('user_id', $id)->where('status', false)->get();
    }

    function getActiveDocs()
    {
        return Document::where('status', true)->get();
    }

    function getActiveDocsByStudent($id)
    {
        return Document::where('user_id', $id)->where('status', true)->get();
    }

    function getDocsByField($field)
    {
        return Document::where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getDocsByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getActiveDocsByField($field)
    {
        return Document::where("field", "like", "%".$field."%")->orWhere('theme', 'like', '%'.$field.'%')
                        ->where('status', true)->get();
    }
/*
    function getActiveDocsByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where('status', true)
                        ->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getDocsInactiveByField($field)
    {
        return Document::where('status', false)->where("field", "like", "%".$field."%")
                        ->orWhere('theme', 'like', '%'.$field.'%')->get();
    }

    function getDocsInactiveByFieldByStudent($field, $id)
    {
        return Document::where('user_id', $id)->where('status', false)
                       ->where("field", "like", "%".$field."%")
                       ->orWhere("theme", "like", "%".$field."%")->get();
    }
*/
    function createDoc(Request $request, $id)
    {
        $document = new Document();
        $document->theme = $request->theme;
        $document->field = $request->field;
        $document->user_id = $id;
        $result = $document->save();
        if($result)
        {
            return $document;
        }
        else
        {
            return response(
                ["message"=> 'An error occured']
            );
        }
    }

    function addDocFile(Request $request, $id)
    {
       $document = Document::find($id);
       $document->pathFile = $request->file('file')->store('apiDocs');
       $result = $document->save();
       if($result)
       {
           return $document;
       }
       else
       {
           return response(
               ['message'=>'An error occurs']
           );
       }
    }

    function deleteDoc(Request $request)
    {
        $document = Document::find($request->id);
        $result = $document->delete();
        if($result)
        {
            return response([
                'message'=>'Removed successfully'
            ]);
        }
        else
        {
            return response([
                'message'=>'An error occurs'
            ]);
        }
    }

    function changeDocStatus($id)
    {
        $document = Document::find($id);
        if($document->status = false)
        {
            $document->status = true;
            $result = $document->save();
            if($result)
            {
                return response([
                'message'=> "Status changed"
            ]);
            }
            else
            {
                return response(
                    ['message'=>"An error occurs"]
                );
            }
        }
        else
        {
            $document->status = false;
            $result = $document->save();
            if($result)
            {
                return response([
                'message'=> "Status changed"
            ]);
            }
            else
            {
                return response(
                    ['message'=>"An error occurs"]
                );
            }
        }
    }

    function editDoc(Request $request, $id)
    {
        $document = Document::find($id);
        $document->theme = $request->theme;
        $document->field = $request->field;
        $result = $document->save();
        if($result)
        {
            return $document;
        }
        else
        {
            return response(
                ["message"=> 'An error occured']
            );
        }
    }
}
