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
        $data = []; 
        try {
            
            $formFields = $request->validate([
                'userName' => ['required', 'string'],
                'password' => ['required', 'string']
            ]);
    
            
            if(auth()->attempt($formFields)){
                $user = Auth::user();
                $token = $user->createToken('access_token')->accessToken;
                $user = User::find($user->id);
                $data['data']['user'] = $user;
                $data['data']['token'] = $token;
                $data['isSuccess'] = true;
                $data['message'] = "Authorized! You are now logged in.";
            }else{
                throw new \Exception('Invalid username/password');
            }
            return response()->json($data, HttpStatus::OK);
        } catch (\Throwable $th) {
            return response()->json([
                'isSuccess' => false,
                'message' => $th->getMessage(),
                'data' => []
            ], HttpStatus::UNAUTHORIZED);
        }

    }
}   

