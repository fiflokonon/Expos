<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
|                           API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('roles', [RoleController::class, 'getRoles']);
Route::get('role/{id}', [RoleController::class, 'getRole']);
Route::post('role/add', [RoleController::class, 'createRole']);
Route::put('role/{id}/edit', [RoleController::class, 'editRole']);
Route::delete('role/{id}/delete', [RoleController::class, 'deleteRole']);

Route::get('speciality/{id}', [SpecialityController::class, 'getSpeciality']);
Route::get('specialities', [SpecialityController::class ,'getAllSpecialities']);
Route::post('addspec', [SpecialityController::class, 'createSpeciality']);
Route::put('editspec/{id}', [SpecialityController::class, 'editSpeciality']);
Route::delete('deletespec/{id}', [SpecialityController::class, 'deleteSpeciality']);

Route::get('students', [UserController::class, 'getAllStudents']);
Route::post('login', [UserController::class, 'login']);
Route::post('signup', [UserController::class,'signup']);
Route::post('user/{id}/addprofilephoto', [UserController::class, 'addUserProfilePhoto']);
Route::put('user/{id}/editprofile', [UserController::class, 'editUser']);
Route::delete('user/{id}/delete', [UserController::class, 'deleteUser']);
Route::get('promo/{promo}/students', [UserController::class, 'getStudentsByPromo']);
Route::delete('students/promo/{promo}/delete', [UserController::class, 'deletePromoStudents']);
Route::get('speciality/{id}/students', [UserController::class, 'getStudentsBySpeciality']);

Route::post('/student/{id}/document/create', [DocumentController::class, 'createDoc']);
Route::post('document/{id}/file', [DocumentController::class, 'addDocFile']);
Route::delete('document/{id}/delete', [DocumentController::class, 'deleteDoc']);
Route::put('document/{id}/supress', [DocumentController::class, 'changeDocStatus']);
Route::put('document/{id}/update', [DocumentController::class, 'editDoc']);
Route::get('documents', [DocumentController::class, 'getAllDocs']);
Route::get('document/{id}', [DocumentController::class, 'getDoc']);
Route::get('student/{id}/documents', [DocumentController::class, 'getDocsByStudent']);
Route::get('documents/noactive', [DocumentController::class, 'getDocsInactive']);
Route::get('student/{id}/documents/noactive', [DocumentController::class, 'getDocsInactiveByStudent']);
Route::get('documents/active', [DocumentController::class, 'getActiveDocs']);
Route::get('student/{id}/documents/active', [DocumentController::class, 'getActiveDocsByStudent']);
Route::get('documents/search/{field}', [DocumentController::class, 'getDocsByField']);
Route::get('documents/active/search/{field}', [DocumentController::class, 'getActiveDocsByField']);

/*Route::get('student/{id}/documents/active/search/{field}', [DocumentController::class, 'getActiveDocsByFieldByStudent']);
Route::get('noactive/documents/{field}', [DocumentController::class, 'getDocsInactiveByField']);
Route::get('student/{id}/noactive/documents/{field}', [DocumentController::class, 'getDocsInactiveByFieldByStudent']);*/


Route::get('suggestions', [SuggestionController::class, 'getAllSuggestions']);
Route::post('student/{id}/suggestion/create', [SuggestionController::class, 'createSuggestion']);
Route::delete('suggestion/{id}/delete', [SuggestionController::class, 'deleteSuggestion']);