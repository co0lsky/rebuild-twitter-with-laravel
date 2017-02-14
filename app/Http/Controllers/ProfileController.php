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
    	$me = Auth::user();
		$is_edit_profile = (Auth::id() == $user->id);
		$is_follow_button = !$is_edit_profile && !$me->isFollowing($user);

        return view('profile', ['user' => $user, 'is_edit_profile' => $is_edit_profile, 'is_follow_button' => $is_follow_button]);
    }

    // public function following()
    // {
    // 	$list = User::

    // 	return view('following', ['list' => $list]);
    // }
}
