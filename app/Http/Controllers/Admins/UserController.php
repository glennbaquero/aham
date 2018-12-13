<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Carbon\Carbon;

use Alert;

class UserController extends Controller
{
    public function verifyAccount($token)
    {
    	$user = User::whereEmailToken($token)->whereIsVerified(false)->first();

    	$user->is_verified = true;

    	$user->save();

        alert()->success('Account is now activated!', 'Account is verified you can now use your account! Thank you!');

    	return redirect()->route('login');
    }
}
