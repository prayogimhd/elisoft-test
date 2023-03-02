<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $rules = array(
            'email'     => 'required|email|max:50',
            'password'  => 'required|min:8',
        );

        $custommessage = array(
            'email.required'    => 'Email Wajib Di isi',
            'password.required' => 'Password Wajib Di isi',
            'min'               => 'Password Minimal 8 Karakter',
            'email'             => 'Email Tidak Valid',
        );

        $request->validate($rules, $custommessage);

        $email      = $request->email;
        $password   = $request->password;
        $user       = User::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Session::put('id', $user->id);
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('login', true);
                return redirect('/user');
            } else {
                return redirect('/')
                    ->with('status', 'error')
                    ->with('messages', 'Password Salah');
            }
        } else {
            return redirect('/')
                ->with('status', 'error')
                ->with('messages', 'Email tidak ditemukan');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function actionRegister(Request $request)
    {
        $rules = array(
            'name'              => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:8|max:30',
            'confirm_password'  => 'required|min:8|same:password',
        );

        $custom_message = array(
            'required'              => ':attribute Wajib di isi.',
            'unique'                => ':attribute Sudah digunakan',
            'name.regex'            => 'Nama Hanya Dapat Berupa Huruf',
            'name.min'              => 'Nama Minimal 3 huruf',
            'password.min'          => 'Password Minimal 8 Karakter',
            'password.max'          => 'Password Maksimal 30 Karakter',
            'confirm_password.min'  => 'Password Minimal 8 Karakter',
            'confirm_password.same' => 'Konfirmasi password tidak sama',
        );

        $name = array(
            'name'              => 'Nama',
            'email'             => 'Email',
            'password'          => 'Password',
            'confirm_password'  => 'Konfirmasi Password',
        );

        $request->validate($rules, $custom_message, $name);

        try {
            $user           = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/')
                ->with('success', 'success')
                ->with('messages', 'Registrasi berhasil!');
        } catch (\Throwable $th) {
            return redirect('/register')
                ->with('status', 'failed')
                ->with('messages',  $th->getMessage());
        }
    }

    public function actionLogout()
    {
        Session::flush();
        return redirect('/')
            ->with('success', 'success')
            ->with('messages', 'Berhasil Logout');
    }
}
