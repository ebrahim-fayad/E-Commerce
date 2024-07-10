<?php
namespace App\Repository\Seller\Auth;

use App\Interfaces\Seller\Auth\SellerForgetPasswordRepositoryInterface;
use App\Mail\SellerRestPassword;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use constDefaults;
use Illuminate\Support\Facades\Hash;

class SellerForgetPasswordRepository implements SellerForgetPasswordRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create() {
        return view('Back.pages.Sellers.Auth.forget-password');
    }

    /**
     * @inheritDoc
     */
    public function sendPasswordRestLink($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:sellers,email'],[
            'email.required'=>'The :attribute is required',
            'email.email'=>'Invalid email address',
            'email.exists'=>'The :attribute is not exists in our system'
        ]]);
        $seller = Seller::where('email', $request->email)->first();
        $token = base64_encode(Str::random(64));
        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $seller->email, 'guard' =>'seller'])
            ->first();
            if ($oldToken) {
                DB::table('password_reset_tokens')
                    ->where(['email' => $seller->email, 'guard' =>'seller'])
                    ->update([
                        'token' => $token,
                        'created_at' => now()
                    ]);
            } else {
                DB::table('password_reset_tokens')->insert([
                    'email' => $seller->email,
                    'guard' =>'seller',
                    'token' => $token,
                    'created_at' => now()
                ]);
            }
        Mail::to($seller->email)->send(new SellerRestPassword($seller, $token));
            return redirect()->route('seller.forget-seller-password')->with('success','We have e-mailed your password reset link.');


    }

    /**
     * @inheritDoc
     */
    public function resetPassword($email, $token) {
        $get_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => 'seller'])
            ->first();

        if ($get_token) {
            //Check if this token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $get_token->created_at)->diffInMinutes(Carbon::now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                //When token is older that 15 minutes
                return redirect()->route('seller.forget-seller-password', ['email'=>$email,'token' => $token])->with('fail', 'Token expired!. Request another reset password link.');
            } else {
                return view('Back.pages.Sellers.Auth.reset-password')->with(['token' => $token]);
            }
        } else {
            return redirect()->route('seller.forget-seller-password', ['email' => $email, 'token' => $token])->with('fail', 'Invalid token!, request another reset password link.');
        }
    }

    /**
     * @inheritDoc
     */
    public function resetPasswordHandler($request, $token) {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:confirm_new_password|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);
        $token = DB::table('password_reset_tokens')
            ->where(['token' => $request->token, 'guard' => 'seller'])
            ->first();

        //Get seller details
        $seller = Seller::where('email', $token->email)->first();

        //Update seller password
        Seller::where('email', $seller->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        //Delete token record
        DB::table('password_reset_tokens')->where([
            'email' => $seller->email,
            'token' => $request->token,
            'guard' => 'seller'
        ])->delete();
        return redirect()->route('seller.login')->with('success', 'Done!, Your password has been changed. Use new password to login into system.');

    }

}
