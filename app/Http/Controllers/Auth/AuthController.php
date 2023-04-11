<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dsvrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller

{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        switch($request->role) {
            case('staff'):
                $check->assignRole('staff');
                break;
            case('project-leader'):
                $check->assignRole('project-leader');
                break;
            case('unit-head'):
                $check->assignRole('unit-head');
                break;
        }

        return redirect("dashboard")->withSuccess('Great! You have Successfully created a new user');
    }

    /**
     * Write code on Method
     *
     *
     */
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            $your_requests = Dsvrequest::where('userid', $user->id)->get();
            $awaiting_requests = Dsvrequest::where('projectleader', $user->id)->orWhere('unithead', $user->id)->get();

            return view('dashboard', ['requests' => $your_requests, 'awaiting_requests' => $awaiting_requests]);
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
