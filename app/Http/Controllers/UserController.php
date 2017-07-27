<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /*
      method for follow user by username after login
      return redirect page to username
    */
    public function follows(Request $request)
    {

      $username = $request->input('username');

      try {
        // Find the user, redirect if user does not exist
        $user = User::where('username', $username)->firstOrFail();
      } catch (ModelNotFoundException $exp) {
        return $this->responseFail('User does not exits');
      }
      // Find id for user logged
      $id = Auth::id();
      $me = User::find($id);

      $me->following()->attach($user->id);

      return $this->responseSuccess();
    }

    /*
      method for unfollow user by username after login
      return redirect page to username
    */
    public function unfollows(Request $request)
    {
      $username = $request->input('username');

      try {
        // Find the user, redirect if user does not exist
        $user = User::where('username', $username)->firstOrFail();
      } catch (ModelNotFoundException $exp) {
        return $this->responseFail('User does not exits');
      }
      // Find id for user logged
      $id = Auth::id();
      $me = User::find($id);

      $me->following()->detach($user->id);

      return $this->responseSuccess();
    }

    /*
      method for status and message response if username follow or unfollow user
      return json array
    */
    private function response($status = false, $message = '')
    {
      return response()->json([
        'status' => $status,
        'message' => $message,
      ]);
    }

    /*
      method for reponse follow / unfollow is success
      return response message json
    */
    private function responseSuccess($message = '')
    {
      return $this->response(true, $message);
    }

    /*
      method for reponse follow / unfollow is fail
      return response message json
    */
    private function responseFail($message = '')
    {
      return $this->response(false, $message);
    }
}
