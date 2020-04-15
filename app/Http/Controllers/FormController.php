<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function uploadFormImg()
    {
        $imgpath = request()->file('file')->store('/images/uploads', 'public');
        return response()->json(['location' => asset($imgpath)]);
    }
}
