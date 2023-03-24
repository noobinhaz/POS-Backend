<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Engine\HttpStatus\HttpStatus;

class UserControl extends Controller
{
    //
    public function register(){
        return view('Create.user');
    }

    public function store(Request $request){
        try {
            
            $formFields = $request->validate([
                'userType' => ['required', 'integer'],
                'userName' => ['required', 'string'],
                'fullName' => ['required', 'string'],
                'gender' => ['required', 'string'],
                'email' => ['required', 'string'],
                'password' => ['required', 'string'],
                'mobileNumber' => ['required', 'string'],
            ]);

            if($formFields['password'] != $request->confirm_password){
                return back()->with('error','Password and Confirm password should match');
            }

            $formFields['password'] = bcrypt($formFields['password']);
            // $formFields['created_by'] = auth()->user()->id;

            User::create($formFields);

            $message = 'User Created Successfully';
            
            return redirect('/register')->with('success','User Created Successfully');

        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());

        }
    }
    public function index(){
        $users = User::paginate(10);
        $fields = ['Serial','Full Name', 'User Name', 'User Type', 'Email', 'Mobile Number', 'Action'];
        
        return view('Users.index')->with(['data'=> $users, 'fields'=> $fields]);
    }

    public function show(Request $request, $id){
        $user = User::find($id);
        return view('Edit.user')->with(['data'=>$user]);
    }
    
    public function destroy(Request $request, $id){
        User::where('id', $id)->delete();

        return redirect('users')->with('message', 'User Deleted Successfully');
    }

    public function update(Request $request, $id){
        // dd($request->all());
        try {
            
            $formFields = $request->validate([
                'userType' => ['required', 'integer'],
                'userName' => ['required', 'string'],
                'fullName' => ['required', 'string'],
                'gender' => ['required', 'string'],
                'email' => ['required', 'string'],
                
                'mobileNumber' => ['required', 'string'],
            ]);

            if(!empty($request->password)){

                if($request->password != $request->confirm_password){
                    return back()->with('error','Password and Confirm password should match');
                }

                $formFields['password'] = bcrypt($request->password);
            }

            // $formFields['created_by'] = auth()->user()->id;

            User::where('id', $id)->update($formFields);
            
            return redirect('/users')->with('success','User Updated Successfully');

        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());

        }
    }

   
    public function authenticate(Request $request){
        // dd($request->all());
        try {

            $formFields = $request->validate([
                'userName' => ['required', 'string'],
                'password' => ['required', 'string']
            ]);
    
            
            if(auth()->attempt($formFields)){
                $request->session()->regenerate();
            }else{
                throw new \Exception('Invalid username/password');
            }
            
            return redirect('/dashboard')->with('message', 'Authentication Success! Logged in!');
        } catch (\Throwable $th) {
            return back()->withErrors(["userName"=>"Invalid userName", "password"=>"Invalid Password"]);
        }

    }

    public function login(Request $request){
        return view('Users.login');
    }
}   

