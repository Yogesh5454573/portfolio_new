<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->guard('admin')->check()) {
            return redirect(route('admin.dashboard'));
        }
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt($credentials)) {
            $adminData = auth('admin')->user();

            activity('login')
                ->performedOn((new Admin))
                ->causedBy($adminData)
                ->withProperties([
                    'id' => $adminData->id,
                    'name' => $adminData->name,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ])
                ->tap(function (Activity $activity) use ($adminData) {
                    $activity->event = 'login';
                    $activity->subject_id = $adminData->id;
                })
                ->log('Login');
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $adminData = auth('admin')->user();

        activity('logout')
            ->performedOn((new Admin))
            ->causedBy($adminData)
            ->withProperties([
                'id' => $adminData->id,
                'name' => $adminData->name,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ])
            ->tap(function (Activity $activity) use ($adminData) {
                $activity->event = 'logout';
                $activity->subject_id = $adminData->id;
            })
            ->log('Logout');

        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
