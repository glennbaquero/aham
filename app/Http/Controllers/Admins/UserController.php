<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

    public function fetchDetails()
    {
    	return response()->json([
    		'details' => auth()->user()
    	]);
    }

    public function update(Request $request, $id)
    {
        User::find($id)->update([
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'contact' => $request->input('contact'),
            'birthday' => $request->input('birthday'),
        ]);

        return response()->json([
            'response' => 'Success'
        ]);
    }

    public function updatepassword(Request $request, $id)
    {

        $response;
        $user = User::find($id);

        if(Hash::check($request->input('old_password'), $user->password)){
            $user->update = Hash::make($request->input('password'));
            $response = 1;
        } else {
            $response = 404;
        }

        return response()->json([
            'response' => $response
        ]);
    }
}
