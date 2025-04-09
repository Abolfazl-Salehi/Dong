<?php

use App\Http\Controllers\FriendRequestController;
use App\Models\FriendRequest;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/test', function () {
//     dd(User::query()->with(['allFriends'])->first()->toArray());
// });




