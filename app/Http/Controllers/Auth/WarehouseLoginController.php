<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Hash;

class WarehouseLoginController extends Controller
{
  public function register()
  {
    Auth::logout();
    return view('auth.warehouse.register');
  }

  public function warehouseRegister(Request $request)
  {
    // dd(config('userTypes.userTypes'));
    $request->validate([
      'name' => 'required',
    ]);
    // dd($request->all());
    DB::beginTransaction();

    try {
        // Save User Data
      $user = new User;
      $user->email = $request->email;
      $user->name = $request->name;
      $user->password = Hash::make($request->password);
      $user->user_type = config('userTypes.userTypes')['WAREHOUSE_MANAGER'];
      $user->save();
   
      // End of saving User Data
      DB::commit();

    } catch (\Exception $e) {
        dd($e);
        DB::rollback();
        return back()->withErrors([$e->getMessage()]);
    }   
    
    return redirect()->route('warehouse_login')
                    ->with('success','Customer created successfully.');
  }

  public function login()
  {
    Auth::logout();
    return view('auth.warehouse.login')
           ->withTitle('Customer Log In');
  }

  public function warehouseLogIn(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      // Authentication passed...
      $user_type = Auth::user()->user_type;
    //   dd($user_type);
      switch ($user_type) {
        case 4:
          return redirect()->route('warehouse');
          break;
        
        default:
          Auth::logout();
          return redirect()->route('warehouse_login');
          break;
      }
      
    } else {
      return redirect()->route('warehouse_login');
    }
  }
  

public function redirectTo()
{
return app()->getLocale() . '/warehouse';
}
 
}
