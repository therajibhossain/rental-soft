<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Traits\APITrait;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use APITrait;

    public function login(Request $request) {
        try{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $auth = Auth::user(); 
                $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
                $success['name'] =  $auth->name;
    
                return $this->handleResponse($success, 'User logged-in!');
            } else{ 
                return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        } 
    }

    public function register(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
    
            if($validator->fails()){
                return $this->handleError($validator->errors());       
            }
    
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] =  $user->name;
    
            return $this->handleResponse($success, 'User successfully registered!');
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        } 
    }
}
