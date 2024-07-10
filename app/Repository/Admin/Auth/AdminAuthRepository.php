<?php
namespace App\Repository\Admin\Auth;

use App\Interfaces\Admin\Auth\AdminAuthRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AdminAuthRepository implements AdminAuthRepositoryInterface
{
    public function index()
    {
        return view('Back.pages.Admin.index');
    }

    public function create()
    {
        return view('Back.pages.Admin.Admin-auth.admin-login');
    }

    public function store($request)
    {
        $this->ensureIsNotRateLimited($request);
        return $this->authenticate($request);
    }

    public function authenticate($request)
    {
        $filedType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required.',
                'login_id.email' => 'Invalid email address.',
                'login_id.exists' => 'Email is not exists in system.',
                'password.required' => 'Password is required'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:admins,name',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'Email or Username is required.',
                'login_id.exists' => 'Username is not exists in system.',
                'password.required' => 'Password is required'
            ]);
        }

        $cred = [
            $filedType => $request->login_id,
            'password' => $request->password
        ];

        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt($cred, $remember)) {
            RateLimiter::clear($this->throttleKey($request)); // Clear rate limiter on successful login
            return redirect()->route('admin.home');
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
            session()->forget('retry_after'); // إزالة retry_after من الجلسة إذا لم يتم تجاوز الحد
        }
    }

    protected function throttleKey($request)
    {
        return Str::lower($request->input('login_id')) . '|' . $request->ip();
    }

    public function destroy($request)
    {
        Auth::guard('admin')->logout();

        $request->session()->forget('guard.admin');

        $request->session()->regenerateToken();
        session()->flash('success', 'You are logged out successfully');
        return to_route('admin.login');
    }
}
