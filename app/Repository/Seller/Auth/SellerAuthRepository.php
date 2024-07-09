<?php
namespace App\Repository\Seller\Auth;

use App\Interfaces\Seller\Auth\SellerAuthRepositoryInterface;
use App\Mail\SentVerificationEmail;
use App\Models\Seller;
use App\Models\VerificationToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SellerAuthRepository implements SellerAuthRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function index()
    {
        return view('Back.pages.Sellers.index');
    }
    /**
     * @inheritDoc
     */
    public function register()
    {
        return view('Back.pages.Sellers.Auth.register');
    }
    public function createSeller($sellerRequest)
    {
        DB::beginTransaction();
        try {
          $seller=  Seller::create([
            'name'=>$sellerRequest->name,
            'email'=>$sellerRequest->email,
            'password'=>Hash::make($sellerRequest->password),
          ]);

            $token = base64_encode(Str::random(64));
            VerificationToken::create([
                'user_type' => 'seller',
                'email' => $seller->email,
                'token' => $token,
            ]);
            DB::commit();
            Mail::to($seller->email)->send(new SentVerificationEmail($seller,$token));
            return to_route('seller.register-success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('fail','failed');
        }
    }
    /**
     * @inheritDoc
     */

    public function create() {
        return view('Back.pages.Sellers.Auth.seller-login');
    }

    /**
     * @inheritDoc
     */
    public function destroy($request) {
    }



    /**
     * @inheritDoc
     */
    public function store($request) {
    }

    /**
     * @inheritDoc
     */
    public function verify($token, $email) {
        $verifyToken = VerificationToken::where('token', $token)->first();

        if (!is_null($verifyToken)) {
            $seller = Seller::where('email', $email)->first();
            if (!$seller->verified) {
                $seller->verified = 1;
                $seller->email_verified_at = Carbon::now();
                $seller->save();

                return redirect()->route('seller.login')->with('success', 'Good!, Your e-mail is verified. Login with your credentials and complete setup your seller account.');
            } else {
                return redirect()->route('seller.login')->with('info', 'Your e-mail is already verified. You can now login.');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'Invalid Token.');
        }
    }
}
