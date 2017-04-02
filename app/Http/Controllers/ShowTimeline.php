<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ShowTimeline extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        return response()->json($user->timeline());
    }
}
