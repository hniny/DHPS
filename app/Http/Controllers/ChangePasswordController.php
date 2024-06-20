<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
  
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.changePassword.changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        // dd('Password change successfully.');
        return redirect()->route('customer_login');
       
    }
    public function reset()
    {
        return view('users.passwordReset');
    }
    public function resetStore($id)
    {
        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find($id)->update(['password'=> Hash::make($request->new_password)]);
             $user->password = bcrypt($request->password);
               $user->update();
        // return view('users.passwordReset');
        dd('Password change successfully.');
    }
}