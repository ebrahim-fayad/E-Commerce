<?php
namespace App\Repository\Seller\Auth;

use App\Interfaces\Seller\Auth\SellerAuthRepositoryInterface;
use App\Mail\SentVerificationEmail;
use App\Models\Seller;
use App\Models\VerificationToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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

    public function store($request)
    {
        $this->ensureIsNotRateLimited($request);
        return $this->authenticate($request);
    }
    public function authenticate($request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:sellers,email',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required.',
                'login_id.email' => 'Invalid email address.',
                'login_id.exists' => 'Email is not exists in system.',
                'password.required' => 'Password is required'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:sellers,username',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required.',
                'login_id.exists' => 'Username is not exists in system.',
                'password.required' => 'Password is required'
            ]);
        }

        $cred = [
            $fieldType => $request->login_id,
            'password' => $request->password
        ];

        $remember = $request->has('remember');

        if (Auth::guard('seller')->attempt($cred, $remember)) {
            RateLimiter::clear($this->throttleKey($request)); // Clear rate limiter on successful login
            if (!auth('seller')->user()->verified) {
                auth('seller')->logout();
                return redirect()->route('seller.login')->with('fail', 'Your account is not verified. Check in your email and click on the link we had sent in order to verify your email for seller account.');
            } else {
                return redirect()->route('seller.home');
            }
        } else {
            RateLimiter::hit($this->throttleKey($request)); // Increment rate limiter on failed login
            session()->flash('fail', 'Incorrect credentials');
            return back();
        }
    }
    protected function ensureIsNotRateLimited($request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            session(['retry_after' => $seconds]);
            throw ValidationException::withMessages([
            ])->status(429);
        } else {
            session()->forget('retry_after');
        }
    }

    protected function throttleKey($request)
    {
        return Str::lower($request->input('login_id')) . '|' . $request->ip();
    }

    /**
     * @inheritDoc
     */
    public function destroy($request) {
        Auth::guard('seller')->logout();

        $request->session()->forget('guard.seller');

        $request->session()->regenerateToken();
        session()->flash('success', 'You are logged out successfully');
        return to_route('seller.login');

    }
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
