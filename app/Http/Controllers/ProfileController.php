<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class ProfileController extends Controller
{
    /*
      method for show your proflie timeline username
      return array of view
    */
    public function show($username)
    {
      $user = User::where('username', $username)->firstOrFail();

      $followers_count = $user->followers()->count();

      // define variable following count
      $following_count = 0;

      $is_edit_profile = false;
      $is_following = false;

      if (Auth::user()) {
        $is_edit_profile = (Auth::id() == $user->id);
        $me = Auth::user();
        $following_count = $is_edit_profile ? $me->following()->count() : 0;
        $is_following = !$is_edit_profile && !$me->isFollowing($user);
      }

      return view('profile', [
        'user' => $user,
        'followers_count' => $followers_count,
        'is_edit_profile' => $is_edit_profile,
        'following_count' => $following_count,
        'is_following' => $is_following,
      ]);
    }

    /*
      method for user which this following user
      return array of view
    */
    public function following()
    {
      $me = Auth::user();

      $followers_count = $me->followers()->count();
      $following_count = $me->following()->count();

      $list = $me->following()->orderBy('username')->get();

      $is_edit_profile = true;
      $is_following = false;

      return view('following', [
        'user' => $me,
        'followers_count' => $followers_count,
        'is_edit_profile' => $is_edit_profile,
        'following_count' => $following_count,
        'is_following' => $is_following,
        'list' => $list,
      ]);
    }

    /*
      method for user which this followers user
      return array of view
    */
    public function followers($username)
    {
      $user = User::where('username', $username)->firstOrFail();

      $followers_count = $user->followers()->count();

      $list = $user->followers()->orderBy('username')->get();

      $is_edit_profile = false;
      $is_following = false;

      // cek auth user after login
      if (Auth::check()) {
        $is_edit_profile = (Auth::id() == $user->id);

        $me = Auth::user();
        $following_count = $is_edit_profile ? $me->following()->count() : 0;
        $is_following = !$is_edit_profile && $me->isFollowing($user);
      }

      return view('followers', [
        'user' => $user,
        'followers_count' => $followers_count,
        'is_edit_profile' => $is_edit_profile,
        'following_count' => $following_count,
        'is_following' => $is_following,
        'list' => $list,
      ]);
    }
}
