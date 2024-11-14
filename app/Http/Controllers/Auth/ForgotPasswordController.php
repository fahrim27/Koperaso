<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use Mail;
use Session;

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

    // use SendsPasswordResetEmails;
    public function showForgetPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $User   = User::where('email',$request->email)->count();
        if ($User<=0) {
            Session::flash('error_message', 'Email tidak terdaftar, silahkan periksa kembali.');
            return redirect()->back();
        }
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = base64_encode(str_random(64));
    //   dd($token);
        $Email    = $request->email;
        DB::table('password_resets')->insert([
            'email' => $Email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        $urlAdmin    = env("APP_URL")."/reset-password"."/".$token;
        $data = [
            'url' => $urlAdmin,
            'email' => $Email,
            'token' => $token,
        ];
        // dd($data);
        if(companySetting("notif_email") == 1){
            Mail::to($Email)->send(new ForgotPasswordMail($data));
        }

        Session::flash('flash_message', 'Periksa Email Untuk Mengatur Ulang Kata Sandi Anda.');
        return redirect()->back();
    }

    public function showResetPasswordForm($id)
    { 
        // dd($id);
        $Data = DB::select("select * from password_resets where token=?",[$id]);
        $Email = [];
        if ($Data != []){
            foreach ($Data as $k) {
                $Email =$k->email;
            }
        }else{
            Session::flash('error_message', 'Token sudah kadaluarsa, Silahkan klik Lupa Kata Sandi');
            return redirect('/login');
        }
        

        return view('auth.passwords.reset', compact('id', 'Email'));
    }

    public function submitResetPasswordForm(Request $request)
    {
        // dd($request);
        if ($request->password != $request->password_confirmation)
        {
            Session::flash('error_message', 'Kata sandi tidak sama, silahkan periksa kembali.');
            return redirect()->back()->withInput();
        }
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')->where([
                        'email' => $request->email, 
                        'token' => $request->token
                        ])->first();
        if(!$updatePassword){
            Session::flash('error_message', 'Token sudah kadaluarsa, Silahkan klik Lupa Kata Sandi');
            return redirect('/login');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')
        ->where(['email'=> $request->email])->delete();

        Session::flash('flash_message', 'Kata sandi berhasil diubah, silahkan masuk ke akun Anda kembali');
        return redirect('/login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
