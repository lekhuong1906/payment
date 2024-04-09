<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('mongodb', function(){
   $data = User::get(); 
   return response()->json(['data'=>$data]);
});