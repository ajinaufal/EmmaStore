<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        /*** must have in every page ***/
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        /*** end of must have in every page ***/

        return view('profile')->with($data);
    }

    public function update(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'current_password' => 'min:6',
            'new_password' => 'min:6',
            'firstname' => 'required',
            'lastname' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'kota' => 'required',
        ];

        $messages = [
            'email.required'                => 'Email wajib diisi',
            'email.email'                   => 'Email tidak valid',
            'firstname.required'            => 'Nama Depan wajib diisi',
            'lastname.required'             => 'Nama Belakang wajib diisi',
            'telephone.required'            => 'No Telepon wajib diisi',
            'address.required'              => 'Alamat wajib diisi',
            'postal_code.required'          => 'Kode Pos wajib diisi',
            'kota.required'                 => 'Kota wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = auth()->user();

        if ($request->has('new_password') && Hash::check($request->current_password, auth()->user()->password)) {
            $password = Hash::make($request->new_password);
        } else {
            $password = auth()->user()->password;
        }
        $update = $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'kota' => $request->kota,
            'email' => $request->email,
            'password' => $password,
        ]);

        return redirect('/');
    }
}
