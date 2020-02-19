<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Notifications\UserResetPasswordNotification;

use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.reset');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('users');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $user_check = User::where('email', $request->email)->first();
        if(!$user_check) {
            alert()->error('Oooops', 'Email does not exist!');
            return back();
        }
        if (!$user_check->email_verified_at) {
            alert()->error('Oooops', 'Your account is not activated. Please activate it first.');
            return back()->with('error', 'Your account is not activated. Please activate it first.');
        } else {
            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            // $user_check->notify(new UserResetPasswordNotification());

            if ($response === Password::RESET_LINK_SENT) {
                alert()->success('Hooray!', 'We sent the reset password link to your email!');
                return back()->with('success', trans($response));
            }

            return back()->withErrors(
                ['email' => trans($response)]
            );
        }
    }

}
