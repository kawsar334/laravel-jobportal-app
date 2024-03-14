<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'password' => 'required',

        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->designation = $request->designation;
            $user->image = $request->image;
            $user->mobile = $request->mobile;
            $user->save();
            session()->flash('success', 'You have registered successfull !');


            return response()->json([
                'status' => true,
                'errors' => [],
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function authentication(Request $request)
    {
        // $user = User::where('email', $request->email)->first();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                // $user = auth()->user(); //
                // dd($user);
                // return redirect()->route('account.profile')->with('user',$user);
                return redirect()->route('account.profile', ['user' => $user]);
            } else {
                session()->flash('error', 'Invalid email or password');
                return redirect()->back()->withInput($request->only('email'));
            }
        } else {
            session()->flash('error', 'Please fix the errors below');
            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
    }


    // profile  view 
    public function profile()
    {

        $user = Auth::user();
        return view('front.profile', ['user' => $user]);
    }


    public function logout()
    {

        Auth::logout();
        return redirect()->route('account.login');
    }
    // update profile 

    public function updateprofile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::where(['id' => $id])->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'designation' => 'required',
        ]);


        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;

            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->save();
            session()->flash('success', 'updated successfully');
            return redirect()->route('account.profile');
        } else {
            session()->flash('errors', 'please fill all these fields');
            return redirect()->route('account.profile')->withErrors($validator);
        }
    }


    // update profile picture 
    // public function updateprofilePicture(Request $request)

    // {
    //     $id = Auth::user()->id;
    //    $validator = Validator::make($request->all(),[
    //         'image'=>'required|image'
    //    ]);


    //    if($validator->passes()){
    //     $image = $request->image;
    //     $exten = $image->getClientOriginalExtension();

    //     $imageName = $id.'_'.time().'.'.$exten;
    //     $image->move(public_path('/profil_pic'),$imageName);
    //         $exten = $image->getClientOriginalExtension();
    //         $imageName = $id . '_' . time() . '.' . $exten;

    //      User::where('id',$id)->update(['image'=>$imageName]);

    //     session()->flash('success','profile picture updated');
    //     return  response()->json([
    //         'status'=>true,
    //         'errors'=>[],

    //     ]);
    //    }else{
    //     return response()->json([
    //         'status'=>false,
    //         'errors'=>$validator->errors(),
    //     ]);

    //    }
    // }
    public function updateprofilePicture(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if ($validator->passes()) {
            $image = $request->image;
            $exten = $image->getClientOriginalExtension();
            $imageName = $id . '_' . time() . '.' . $exten;

            try {
                $image->move(public_path('/profile_pic'), $imageName);
                User::where('id', $id)->update(['image' => $imageName]);

                session()->flash('success', 'Profile picture updated');

                return response()->json([
                    'status' => true,
                    'message' => 'Profile picture updated successfully',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error updating profile picture',
                    'error' => $e->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    // create job 

    public function createJob(Request $request){
        $categories = Category::orderBy('name','asc')->where('status',1)->get();



        return view('front.account.job.job',['categories'=>$categories]);
        // return $request->all();

    }

}
