<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Semester;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $guard = 'admin';
    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';

    public function __construct()
    {
        $this->redirectTo = '/admin';
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    public function login() : View
    {
        //Auth::shouldUse('dashboard');

        if (auth()->check()) {
            return redirect('/admin');
        }

        return view('admin.pages.auth.login');
    }

    public function postLogin(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect($this->loginPath)->with('error', 'User not found.');
        }

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->business_id !== null) {
                $business = Business::find($user->business_id);
                if ($business) {
                    session()->put('businessName', $business->name);
                }
                session()->put('businessId', $user->business_id);
                $year = Year::where('business_id', $user->business_id)->where('is_current', 1)->first();
                if ($year) {
                    session()->put('yearId', $year->id);
                }
                $semester = Semester::where('business_id', $user->business_id)->where('is_current', 1)->first();
                if ($semester) {
                    session()->put('semesterId', $year->id);
                }
            }
            return redirect('/admin');
        }

        return redirect($this->loginPath)
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Incorrect email address or password']);
    }


    public function logout() : RedirectResponse
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
