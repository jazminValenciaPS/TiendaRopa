<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
 use Auth as c;

class LoginController extends Controller
{
  use AuthenticatesUsers;


    public function showLoginForm(){
        if(c::check()){
            return redirect('/consola');
        }
        return view('auth.login');
    }

    protected $redirectTo = '/consola';

    public function login(Request $request){

        // $this->validateLogin($request); 
        // ['usuario' => $request->usuario,'password' => $request->password]

        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);             

        if (Auth::attempt(['usuario' => $request->usuario,'password' => $request->password])){
        // ,'password' => $request->password])
            // Auth::loginUsingId(Auth::user()->userTablePrimaryKey);
            // return 'Tu sesión ha sido iniciada con éxito';
            redirect('/consola');
        }

        return back()
        ->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));

    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

    }
    
    public function logout(Request $request){
     Auth::logout();
        $request->session()->invalidate();
        return redirect('/administrador');
    } 

    public function username(){
        
        return 'usuario';
    }


}







