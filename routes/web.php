<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('mongodb', function(){
   $data = User::get(); 
   return response()->json(['data'=>$data]);
});

Route::post('post', function(Request $request){
    $data = $request->data;
    if ($data == 'post'){
        return response()->json(['data' => 'CSRF token mismatch']);
    }
});