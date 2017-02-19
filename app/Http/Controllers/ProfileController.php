<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
    	$user = User::where('username', $username)->firstOrFail();

    	$is_edit_profile = false;
    	$is_following = false;

    	if (Auth::check()) {
			$is_edit_profile = (Auth::id() == $user->id);

			$me = Auth::user();
			$is_following = !$is_edit_profile && $me->isFollowing($user);
    	}

        return view('profile', ['user' => $user, 'is_edit_profile' => $is_edit_profile, 'is_following' => $is_following]);
    }
}
