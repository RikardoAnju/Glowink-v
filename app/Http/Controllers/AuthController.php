<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Member;
use App\Http\Controllers\Controller; 


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    
    
    public function index()
    {
        return view('auth.login');
    }
    // Di dalam metode login
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $token = Auth::guard('api')->attempt($credentials);
        cookie ()->queue(cookie('token', $token, 60));
        // Simpan pesan flash ke dalam sesi
        session()->flash('success', 'Login successful!');
        // Redirect ke halaman yang diinginkan setelah login berhasil
        return redirect()->intended('/adminpage');
    }

    // Jika autentikasi gagal, kembalikan dengan pesan kesalahan
    return redirect('login')->withErrors([
        'error' => 'Email or password is wrong'
    ]);
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
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
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

    public function login_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $member = Member::where('email', $request->email)->first();
        if ($member) {
            if (Hash::check($request->password, $member->password)) {
                $request->session()->regenerate();
                return response()->json([
                    'message' => 'success',
                    'data' => $member
                ]);
            } else {
                return response()->json([
                    'message' => 'failed',
                    'data' => 'Email or Password wrong'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'failed',
                'data' => 'Email or Password wrong'
            ]);
        }
    }
    public function logout()
    {
        session::flush();

        return redirect('/login');
    }
    public function logout_member()
    {
       session::flush();
       return redirect('/login_member');
   }
}
