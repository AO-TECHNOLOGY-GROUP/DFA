<?php

namespace App\Http\Controllers;

use App\Mail\LoginOTP;
use App\SMS;
use App\User;
use App\verificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return (user()) ? redirect()->route('dashboard') : $this->login();
    }

    public function login()
    {
        logout_all_guards();

        return view('login');
    }

    public function processLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $otp_channel = $request->email;

        $remember = $request->has('remember') ? true : false;

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active'
        ];


        // dd($credentials);

        if (Auth::attempt($credentials, $remember)) {

            $user = user();
            $status = $user->status;
            $verifier = $user->verifier_id;

            trail('Login - 1st Step', 'Correct credentials provided');

            if ($verifier != null) {
                if ($status == 'active') {

                    $code = rand(100000, 999999);
                    $generateLoginToken = Str::random(70) . '-' . transaction_uniq();

                    verificationCode::create([
                        'code' => $code,
                        'user_id' => $user->id,
                        'intent' => 'otp',
                        'expires_at' => Carbon::now()->addMinutes(config('admintemplate.otp_validity'))
                    ]);

                    $user_uuid = $user->uuid;

                    $user->update([
                        'login_otp_token' => $generateLoginToken
                    ]);

                    logout_all_guards();

                    $otp_channels = ($user->phone_verified_at) ? $otp_channel : 'email';

                    $this->sendOTP($code, $otp_channels, $user);

                    flash('OTP has been sent to ' . $otp_channels)->info();
                    return view('otp', compact('generateLoginToken', 'code', 'user_uuid'));

                } else {
                    logout_all_guards();
                    flash('Your account is currently disabled - contact your admin')->info();
                    return redirect()->route('login');
                }
            } else {
                logout_all_guards();

                flash('Your account is yet to be verified - contact system admin')->info();
                redirect()->route('login');
            }
        }

        trail('login-attempt', 'Attempted to login with wrong credentials');

        flash('Wrong login credentials used')->error();
        return redirect()->back()->withInput();
    }

    public function loginOTP(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'ref' => 'required',
            'otp' => 'required'
        ]);
     

        $user = User::all()->where('uuid', $request->get('uuid'))->first();

        if (!$user) {
            flash('Unable to login - try again')->error();
            return redirect()->route('login');
        }

        $verification_code = verificationCode::all()->where('user_id', $user->id)->where('intent', 'otp')->where('code', $request->get('otp'))->first();

        if (!$verification_code) {
            flash('Wrong code provided or has expired - Try again')->error();
            return redirect()->route('login');
        }

        Auth::login($user);
        trail('successful-login', 'Logged in successful');

        flash('Welcome to ' . config('app.name'))->important();
        return redirect()->intended(route('index'));
    }

    public function sendOTP($code, $channel, $user)
    {
        Mail::to($user->email, $user->name)->send(new LoginOTP($user, $code));
        //TODO implement both email & sms synchronous
        // get channel variables (sms & email)
        // call each functions in same method (regardless of order)
//        if ($channel === 'email' && $channel === 'phone_number') {
//            Mail::to($user->email, $user->name)->queue(new LoginOTP($user, $code));
////            SMS::
//        }
//        if ($channel === 'phone') {
//            SMS::send($user->phone, 'Your login OTP: ' . $code, Carbon::now()->addMinutes(config('admintemplate.otp_validity')), 1);
//        } else {
//            Mail::to($user->email, $user->name)->send(new LoginOTP($user, $code));
//        }

        return true;
    }

    public function logout()
    {
        trail('logout', 'Logged out');
        logout_all_guards();

        flash("Successfully logged out!")->info();

        return redirect()->route('login');
    }

    public function verify($code)
    {
        $check = verificationCode::where('code', $code)->first();

        if ($check === null) {
            flash('Your account has already been verified or wrong linked used - Login to your account')->info();
            return redirect()->route('login');
        }

        $user = $check->user;

        $user->update([
            'email_verified_at' => now(),
        ]);

        flash('Your email address has already been verified - Kindly set your ' . config('app.name') . 'account password')->info();

        $code_id = $check->id;

        return view('set-password', compact('code', 'code_id'));
    }

    public function setPassword(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'ref' => 'required',
            'password' => 'required'
        ]);

        $code = $request->get('code');
        $ref = $request->get('ref');

        $check = verificationCode::where('code', $code)->where('id', $ref)->first();

        if ($check === null) {
            flash('Your account has already been verified or wrong linked used - Login to your account')->info();
            return redirect()->route('login');
        }

        $user = $check->user;

        $check->delete();

        $user->update([
            'password' => $request->get('password'),
        ]);

        flash()->info('Your account is ready. Login to proceed');
        return redirect()->route('login');
    }
}
