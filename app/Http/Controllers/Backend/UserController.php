<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\user\RecoverPasswordRequest;
use App\Http\Requests\backend\User\UserChangePasswordRequest;
use App\Http\Requests\backend\User\UserCreateRequest;
use App\Http\Requests\backend\User\UserEditRequest;
use App\Http\Requests\backend\user\UserForgotPasswordRequest;
use App\Http\Requests\backend\User\UserLoginRequest;
use App\Http\Requests\backend\User\UserProfileEditRequest;
use App\Mail\CheckoutMail;
use App\Mail\ForgotPasswordMail;
use App\Models\Permissions;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.guest')->only('login','loginView','store','register');
    }

    public function index() : View
    {


        $user=auth('admin')->id();

        $users = User::select('users.*')
            ->join('permissions as p1', 'users.id', '=', 'p1.user_id')
            ->join('permissions as p2', function ($join) use ($user) {
                $join->on('p2.user_id', '=', DB::raw($user));
            })
            ->whereColumn('p1.create', '<=', 'p2.create')
            ->whereColumn('p1.read', '<=', 'p2.read')
            ->whereColumn('p1.update', '<=', 'p2.update')
            ->whereColumn('p1.delete', '<=', 'p2.delete')
            ->where('users.id', '!=', $user)
            ->get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {

        if (User::all()->isEmpty())
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 4, // super admin = 4
            ]);

            $user_permission = Permissions::create([
                'user_id'   => $user->id,
                'create'    => 1,
                'read'      => 1,
                'update'    => 1,
                'delete'    => 1,
            ]);
        }
        else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 1, // user = 1
            ]);
            $user_permission = Permissions::create([
                'user_id'   => $user->id,
                'create'    => 0,
                'read'      => 1,
                'update'    => 0,
                'delete'    => 0,
            ]);
        }
        $user_details = UserDetails::create([
            'user_id' => $user->id,
            'image' => 'backend/default/user.jpg',
        ]);

        return redirect()->route('backend.user.login')->withSuccess('Muveffeqiyyetle profiliniz yaradildi');
    }

    public function show(int $id) :View|RedirectResponse
    {

        $user = User::findOrFail($id);
        if (auth('admin')->id() === $user->id)
        {
            return view('backend.user.show',compact('user'));
        }
        return redirect()->route('backend.user.index')->withSuccess('You are not authorized to view this profile.');
    }

    public function edit(int $id) :View|RedirectResponse
    {

        if (auth('admin')->user()->is_admin>=3) {

            $user = User::findOrFail($id);

            //admin adminde deyiwiklik etmek istedikde
            if ($user->is_admin>=3 && Auth::guard('admin')->id()==$id) {
                return redirect()->route('backend.user.index')->withSuccess('Admin  sadəcə özü dəyişiklik edə bilər');
            }
            //oz profilinde deyiwiklik etmek isdedikde
            if ( Auth::guard('admin')->id() === $user->id){
                return redirect()->route('backend.user.profile_edit',$user->id);
            }
            else {
                //user deyiwiklik etmek isdedikde
                return view('backend.user.edit', compact('user'));
            }
        }
        return redirect()->route('backend.user.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function update(UserEditRequest $request,int $id):View|RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=3) {
            if (auth('admin')->user()->is_admin) {

                $user = User::findOrFail($id);
                $user_details = UserDetails::where('user_id', $id)->firstOrFail();
                if(isset($request->image))
                {
                    $image_name =time() . '.' .$request->file('image')->getClientOriginalName();
                    $image = $request->file('image')->move(public_path('backend/users/images/'), $image_name);
                }
                else
                {
                    $image_name = null;
                    $image = null;
                }

                $user->update( [
                    'name'     => $request->name,
                ]);
                $user_details->update([
                    'image'     => $image ? 'backend/users/images/' . $image_name : $user_details->image,
                    'phone'     => $request->phone,
                    'address'   => ucfirst($request->address),
                    'mobile'    => $request->mobile,
                    'position'  => ucfirst($request->position),
                ]);
                return redirect()->route('backend.user.edit', $user->id)->withSuccess('Yeniləmə ugurla nəticələndi');
            }
            else{
                return view('backend.user.index')->withSuccess('buna səlahiyyətiniz yoxdur');
            }
        }
        return redirect()->route('backend.user.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function destroy(int $id) :View|RedirectResponse
    {
        if (auth('admin')->user()->is_admin>=4) {
            if (auth('admin')->id()==$id) {
                return redirect()->route('backend.user.index')->withSuccess('şəxs özünü silə bilməz bunun ucun dəstək istəyin');
            }
            else{
                if (auth('admin')->user()->is_admin) {
                    $user=User::findOrFail($id);
                    if ($user->is_admin){
                        return redirect()->route('backend.user.index')->withSuccess('Admin silinə bilməz bunun ucun dəstək istəyin');
                    }
                    else
                    {
                        $user->delete();
                        return redirect()->route('backend.user.index')->withSuccess('silinmə ugurla nəticələndi');
                    }

                }
                else{
                    return view('backend.user.index')->withSuccess('buna səlahiyyətiniz yoxdur');
                }
            }
        }
        return redirect()->route('backend.user.index')->withSuccess('Sizin bunu etməyə səlahiyyətiniz yoxdur');

    }

    public function register() :View
    {
        return view('backend.user.create');
    }

    public function login(UserLoginRequest $request) :RedirectResponse
    {

        $credentials = request()->only('email', 'password');
        $remember = request()->has('remember');
        if (Auth::guard('admin')->attempt($credentials, $remember) && Auth::guard('admin')->user()->is_admin)
        {
            return redirect()->route('backend.dashboard');
        }
        else
        {
            return redirect()->route('backend.user.login')->withErrors(['email' => 'Invalid email or password.',])->withInput();
        }

    }
    public function loginView() :View
    {
        return view('backend.user.login');
    }
    public function logout(Request $request) :RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.user.login')->withSuccess( 'Ugurla cixis edildi');
    }
    public function change_password_view() :View
    {
        $user = User::findOrFail(auth('admin')->id());
        if (Auth::guard('admin')->id() === $user->id)
        {
            return view('backend.user.change_password',compact('user'));
        }
        return redirect()->route('backend.user.show')->withSuccess('You are not authorized to view this profile.');
    }
    public function change_password(UserChangePasswordRequest $request):RedirectResponse
    {

        $user = Auth::guard('admin')->user();

        if (Hash::check($request->old_password, $user->password))
        {
            $user->update([
               'password'=> Hash::make($request->new_password)
            ]);
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('backend.user.login')->withSuccess('Password has been changed successfully.');
        }
        return back()->withSuccess('Incorrect current password.');
    }
    public function profile_edit_view(int $id) : View
    {
        if (true) {
            $user = User::findOrFail($id);
            return view('backend.user.profile_edit', compact('user'));
        }

        return view('backend.user.index')->withSuccess('buna səlahiyyətiniz yoxdur');

    }
    public function profile_edit(UserProfileEditRequest $request, int $id): View|RedirectResponse
    {
        if (Auth::guard('admin')->id() === $id) {
            $user = User::findOrFail($id);
            $user_details = UserDetails::where('user_id', $id)->firstOrFail();

            $image_name = isset($request->image) ? time() . '.' . $request->file('image')->getClientOriginalName() : null;
            $image = isset($request->image) ? $request->file('image')->move(public_path('backend/users/images'), $image_name) : null;

            $user->update([
                'name'=>$request->name,
            ]);
            $user_details->update([
                'image'     => $image ? 'backend/users/images/' . $image_name : $user_details->image,
                'phone'     => $request->phone,
                'address'   => ucfirst($request->address),
                'mobile'    => $request->mobile,
                'position'  => ucfirst($request->position),
            ]);

            return view('backend.user.profile_edit', compact('user'))->withSuccess('Uğurla detallar dəyişdirildi');
        } else {
            return view('backend.user.index')->withSuccess('Buna səlahiyyətiniz yoxdur');
        }
    }
    public function forgot_password_view():View
    {
         return view("backend.user.forgot_password");
    }
    public function forgot_password(UserForgotPasswordRequest $request)
    {
        $email=$request->email;
        if (User::where('email', $email)->exists())
        {

            $min = 100000; // Minimum six-digit number (100000)
            $max = 999999; // Maximum six-digit number (999999)
            $randomCode = rand($min, $max);

            // Ensure the code is exactly six digits
            $randomCode = str_pad($randomCode, 6, '0', STR_PAD_LEFT);
            $hiddenEmail = substr($email, 0, 3) . '******' . substr($email, strpos($email, '@'));
            // Store the code in the session


            $body = session([
                'otp'           =>      $randomCode,
                'hiddenEmail'   =>      $hiddenEmail,
                'email'         =>      $email,
                'name'          =>      User::where('email',$email)->first()->name,
            ]);

            $mailData = [
                'title' => 'Furniture shirketi size otp verifikasiya kodu gonderdi',
                'body' =>   session('otp'),
            ];

            Mail::to($request->email)->send(new ForgotPasswordMail($mailData));

            return redirect()->route('backend.user.otp_code');

        }
        else
        {
            return redirect()->route("backend.user.forgot")->withSuccess('bele bir email movcud deyil');
        }
    }
    public function otp_view():View
    {
        if (session()->has('otp'))
        {
            return view('backend.user.otp_code');
        }
        else
        {
            return redirect()->route('backend.user.login')->withSuccess('girish mumkun olmadi');
        }
    }
    public function otp_check(Request $request){
        $otp_number = $request->input('_finalKey');

        if ($otp_number==session('otp'))
        {

            session(['otp_code_is_checked'=>'otp_code_is_checked']);
            return response()->json([
                'status' => 200,
            ]);
        }

            return response()->json([
                'status' => 404,
            ]);
    }
    public function recover_password_view(){
        if (session()->has('otp_code_is_checked'))
        {
            return view('backend.user.recover_password');
        }
        else{
            return redirect()->route('backend.user.login')->withSuccess('girish mumkun olmadi');
        }

    }
    public function recover_password(RecoverPasswordRequest $request){

        if (session()->has('otp_code_is_checked'))
        {

            $user = User::where('email', session('email'))->firstOrFail();

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            session()->flush();
            return redirect()->route('backend.user.login')->withSuccess('Sizin şifrəniz muvəffəqiyyətlə dəyişdirildi. Giriş edə bilərsiniz');
        }
        else{
            return redirect()->route('backend.user.login')->withSuccess('Giriş mümkün olmadı');
        }

    }
    /*private function uploadFile($request, $fileName)
    {
        if ($request->hasFile($fileName)) {
            $name = $fileName . time() . '.' . $request->file($fileName)->extension();
            $request->file($fileName)->move(public_path() . '/movies/', $name);
            return $name;
        }
        return null;
    }*/
}
