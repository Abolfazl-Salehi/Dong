<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function Success()
    {

        return response()->json(['message' => 'عملیات با موفقیت انجام شد.'], 200);
    }
}
