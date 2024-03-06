<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //


    public function Registration()
    {
        return view('front.account.register');
    }
    public function login()
    {
        return view('front.account.login');
    }
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|password',
           
        ]);
        if($validator->passes()){
            $user = new User();
            $user->name= $request->name;
            $user->email= $request->email;
            $user->password = $request->password;
            $user->designation= $request->designation;
            $user->image= $request->image;
            $user->mobile= $request->mobile ;
            $user->save();
            session()->flash('success','You have registered successfull !');

           
            return response()->json([
                'status'=>true,
                'errors'=>[],
                'data'=>$user,
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }


    public function authentication(Request $request){
        $user = User::where('email', $request->email)->first();
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->passes()){
            // $credintials = $request->only('email','password');
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return view('welcome')->with('user', $user);

            }else{
                session()->flash('error', 'something went wrong');
                return redirect()->back()->withInput($request->only('email'));

            }
        }else{
            session()->flash('error','User not found');
            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
        

    }
}
