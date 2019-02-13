<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    private $successStatus;
    private $unauthorizedStatus;
    /**
     * Construct
     * @return  
     */
    public function __construct()
    {
        $this->successStatus = 200;
        $this->unauthorizedStatus = 401;
    }
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(LoginRequest $request){ 
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MiniAspireApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], $this->unauthorizedStatus); 
        } 
    }
    /** 
     * Create User API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create(UserRequest $request) 
    { 
        $input = $request->all(); 
        $input['password'] = Hash::make($input['password']); 
        $user = User::create($input); 
        return response()->json(['success'=>new UserResource($user)], $this-> successStatus); 
    }
    
}
