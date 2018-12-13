<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function verifyAccount($token)
    {
    	$user = User::whereEmailToken($token)->whereIsVerified(false)->first();

    	$user->is_verified = true;

    	$user->save();

    	return redirect()->route('login');
    }
}
