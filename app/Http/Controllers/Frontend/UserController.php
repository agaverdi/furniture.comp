<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\AccountPasswordChangeRequest;
use App\Http\Requests\frontend\AccountUpdateRequest;
use App\Http\Requests\frontend\LoginRequest;
use App\Http\Requests\frontend\RegisterRequest;
use App\Models\Pages;
use App\Models\Permissions;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index():View
    {
        return view('frontend.register.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {

        $user = User::create([
            'name'      => $request->name,
            'surname'   => $request->surname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'is_admin'  => 0,  // not user only personel  = 0
        ]);

        $user_permission = Permissions::create([
            'user_id'   => $user->id,
            'create'    => 0,
            'read'      => 0,
            'update'    => 0,
            'delete'    => 0,
        ]);

        $user_details = UserDetails::create([
            'user_id' => $user->id,
            'image' => 'backend/default/user.jpg',
            'address' => $request->address,
            'phone' => $request->tel,
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
            return redirect()->route('frontend.register')->withSuccess('Muveffeqiyyetle profiliniz yaradildi');
        }
        return redirect()->route('frontend.register')->withSuccess('Ne ise yanlisliq oldu ');

    }
    public function loginView():View
    {
        return view('frontend.register.login');
    }

    public function login(LoginRequest $request):RedirectResponse
    {
        $credentials = request()->only('email', 'password');
        $remember = request()->has('remember');

        if (Auth::attempt($credentials,$remember)){
            return redirect()->intended('/')->withSuccess('Muveffeqiyyetle daxil oldunuz');
        }

        return redirect()->route('frontend.login')->withErrors(['email' => 'Invalid email or password.',])->withInput();
    }
    public function accountView():View
    {

        $user=User::whereId(auth()->id())->firstOrFail();

        $user_details = UserDetails::where('user_id', auth()->id())->firstOrFail();

        return view('frontend.user.account', compact('user','user_details'));
    }

    public function account(AccountUpdateRequest $request):View| RedirectResponse
    {

        $user = User::findOrFail(auth()->id());
        $user_details = UserDetails::where('user_id', auth()->id())->firstOrFail();

        $user->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
        ]);
        $user_details->update([
            'address'   => ucfirst($request->address),
            'mobile'    => $request->mobile,
            'phone'     => $request->phone ,
        ]);

        return view('frontend.user.account', compact('user','user_details'))->withSuccess('Uğurla detallar dəyişdirildi');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('frontend.index')->withSuccess( 'Ugurla cixis edildi');
    }
    public function changePasswordView(Request $request)
    {
       return view('frontend.user.passwordChange');
    }
    public function changePassword(AccountPasswordChangeRequest $request)
    {
        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password))
        {
            $user->update([
                'password'=> Hash::make($request->new_password)
            ]);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('frontend.login')->withSuccess('Password has been changed successfully.');
        }
        return back()->withSuccess('Incorrect current password.');
    }

}
