<?php
namespace App\Repository\Admin\Auth;

use App\Interfaces\Admin\Auth\AdminForgetPasswordRepositoryInterface;
use App\Mail\ResetPassword;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminForgetPasswordRepository implements AdminForgetPasswordRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create()
    {
        return view('Back.pages.Admin.Admin-auth.forget-password');
    }
    public function sendPasswordRestLink($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
        ], [
            'email.required' => 'The :attribute is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'The :attribute is not exists in system'
        ]);
        $admin = Admin::where('email', $request->email)->first();
        $token = base64_encode(Str::random(64));
        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'guard' => 'admin'])
            ->first();
        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where(['email' => $request->email, 'guard' => 'admin'])->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'guard' => 'admin',
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }
        Mail::to($admin->email)->send(new ResetPassword($admin,$token) );
        session()->flash('success', 'We have e-mailed your password reset link.');
        return redirect()->route('admin.forget-admin-password');

    }
    /**
     * @inheritDoc
     */
    public function resetPassword($request, $token)
    {

        return view('Back.pages.Admin.Admin-auth.reset-password',compact('token'));
    }

    /**
     * @inheritDoc
     */
    public function resetPasswordHandler($request, $token)
    {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);
        $token = DB::table('password_reset_tokens')
            ->where(['token' => $request->token, 'guard' => 'admin'])
            ->first();
        $admin = Admin::where('email', $token->email)->first();
        //Get admin details
        Admin::where('email', $admin->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        //Delete token record
        DB::table('password_reset_tokens')->where([
            'email' => $admin->email,
            'token' => $request->token,
            'guard' =>'admin'
        ])->delete();
        session()->flash('success', 'Password reset successfully.');
        return redirect()->route('admin.login');
    }

    /**
     * @inheritDoc
     */

}
