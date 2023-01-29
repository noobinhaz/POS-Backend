<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Engine\HttpStatus\HttpStatus;

class UserControl extends Controller
{
    //

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

            $formFields['password'] = bcrypt($formFields['password']);
            // $formFields['created_by'] = auth()->user()->id;

            User::create($formFields);

            $message = 'User Created Successfully';
            
            return response()->json([
                'isSuccess' => true,
                'message' => $message,
                'data' => []
            ], HttpStatus::OK);

        } catch (\Throwable $th) {
            return response()->json([
                'isSuccess' => false,
                'message' => $th->getMessage(),
                'data' => []
            ], HttpStatus::BAD_REQUEST);
        }
    }
    public function index(){
        $users = User::get();

        return response()->json([$users], 200);
    }

    public function edit(Request $request, $id){

    }
    
    public function delete(Request $request, $id){}

    public function update(Request $request, $id){}

   
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

