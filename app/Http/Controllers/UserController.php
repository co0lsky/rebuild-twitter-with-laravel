<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function follows(Request $request)
    {
		$username =  $request->input('username');

    	try {
	    	$user = User::where('username', $username)->firstOrFail();
    	} catch (ModelNotFoundException $exp) {
    		return $this->responseFail('User doesn\'t exists');
    	}

    	// Find logged in User
    	$id = Auth::id();
    	$me = User::find($id);

    	$me->following()->attach($user->id);

    	return $this->responseSuccess();
    }

    public function unfollows(Request $request)
    {
		$username =  $request->input('username');

    	try {
	    	$user = User::where('username', $username)->firstOrFail();
    	} catch (ModelNotFoundException $exp) {
    		return $this->responseFail('User doesn\'t exists');
    	}

    	// Find logged in User
    	$id = Auth::id();
    	$me = User::find($id);

    	$me->following()->detach($user->id);

    	return $this->responseSuccess();
    }

    private function responseSuccess($message = '')
    {
    	return $this->response(true, $message);
    }

    private function responseFail($message = '')
    {
    	return $this->response(false, $message);
    }

    private function response($status = false, $message = '')
    {
    	return response()->json([
    		'status' => $status,
    		'message' => $message,
    		]);
    }
}
