<?php

namespace App\Http\Controllers;

use App\Mail\ForgotpassEmail;
use Illuminate\Http\Request;
use App\Rules\RecaptchaV3;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        $data = array();
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();

        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login')->with($data);
    }

    public function doLogin(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            if (Auth::user()->active == "1") {
                $user = new User;
                $user = User::find(Auth::user()->id);
                $user->last_login_date = date("Y-m-d H:i:s");
                $user->save();

                $userUpdate = User::find(Auth::user()->id);
                $userUpdate->last_login = date("Y-m-d H:i:s");
                $saveResult = $userUpdate->save();
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Akun anda belum aktif.');
                return redirect('/');
            }
        } else {
            //Login Fail
            Session::flash('error', 'Email atau Password salah. Silahkan dicoba kembali.');
            return redirect('/');
        }
    }



    public function register()
    {
        $data = array();

        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();

        if (Auth::check()) {
            return redirect('/');
        }
        return view('register')->with($data);
    }


    public function doRegister(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'kota' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];

        $messages = [
            'email.required'                => 'Email wajib diisi',
            'email.email'                   => 'Email tidak valid',
            'email.unique'                  => 'Email sudah terdaftar',
            'password.required'             => 'Password wajib diisi',
            'password.confirmed'            => 'Password tidak sama dengan konfirmasi password',
            'password_confirmation.required'        => 'Password wajib diisi',
            'firstname.required'                 => 'Nama Depan wajib diisi',
            'lastname.required'                 => 'Nama Belakang wajib diisi',
            'telephone.required'            => 'No Telepon wajib diisi',
            'address.required'                => 'Alamat wajib diisi',
            'postal_code.required'                    => 'Kode Pos wajib diisi',
            'kota.required'                    => 'Kota wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->firstname = ucwords(strtolower($request->firstname));
        $user->lastname = ucwords(strtolower($request->lastname));
        $user->telephone = $request->telephone;
        $user->address = $request->address;
        $user->postal_code = $request->postal_code;
        $user->kota = $request->kota;
        $user->propinsi  = "";
        $user->kabupaten  = "";
        $user->kecamatan  = "";
        $user->active  = "0";
        $user->active  = "0";
        $saveResult = $user->save();

        if ($saveResult) {
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('registersuccess');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function registersuccess()
    {
        $data = array();

        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();

        if (Auth::check()) {
            return redirect()->route('/');
        }
        return view('registersuccess')->with($data);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }

    public function forgotpassword()
    {
        $data = array();
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        return view('forgotpass')->with($data);
    }

    public function doforgotpassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $password = Str::random(8);
        if ($user->count() != 0) {
            $user->update([
                'password' => Hash::make($password),
            ]);
            $send_mail = $user->email;
            $data = [
                'email' => $send_mail,
                'name'  => $user->firstname . " " . $user->lastname,
                'password'  => $password,
            ];
            Mail::to($send_mail)->send(new ForgotpassEmail($data));
            Session::flash('success', 'Reset Password berhasil!');
            return redirect('/');
        } else {
            Session::flash('error', 'Email anda tidak terdaftar, Silahkan dicoba kembali.');
            return redirect()->back();
        }
    }
}
