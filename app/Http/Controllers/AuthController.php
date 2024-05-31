<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);

        if (auth()->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'token' => $token
            ]);
        } else {
            Session::flash('failed', 'Email atau Password salah');
            return redirect('/login')->withInput();
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = Member::create($input);

        return response()->json([
            'message' => 'Data berhasil disimpan.',
            'data' => $member
        ]);
    }

    public function login_member()
    {
        return view('auth.login_member');
    }

    public function login_member_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/login_member')->withInput();
        }

        $credentials = $request->only('email', 'password');
        $member = Member::where('email', $request->email)->first();

        if ($member) {
            if (Auth::guard('webmember')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/');
            } else {
                Session::flash('failed', "Password salah");
                return redirect('/login_member')->withInput();
            }
        } else {
            Session::flash('failed', "Email tidak ditemukan");
            return redirect('/login_member')->withInput();
        }
    }

    public function register_member()
    {
        return view('auth.register_member');
    }

    public function register_member_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required|unique:members,nama_member',
            'no_hp' => 'required',
            'email' => 'required|unique:members,email|email',
            'password' => 'required',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/register_member')->withInput();
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = Member::create($input);

        Session::flash('success', 'Account Successfully Created!!');
        return redirect('/login_member');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function logout_member()
    {
        Auth::guard('webmember')->logout();
        Session::flush();
        return redirect('/');
    }
}
