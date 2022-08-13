<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
   public function registration(RegisterRequest $request): JsonResponse
   {
       try {
           DB::beginTransaction();
           $user = User::createNew($request->validated());
           $auth_token = $user->createToken('my-app-token')->plainTextToken;
           $response_data['user'] = new UserResource($user);
           $response_data['token'] = ['auth_token' => $auth_token];
           DB::commit();
       } catch (Throwable $throwable) {
           DB::rollBack();
           return $this->apiResponse('404', "Not Register");
       }
       return $this->apiResponse('202', "Register Done" , $response_data);
   }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            if (!Auth::attempt($request->validated())) {
                return response()->json([
                    'message' => 'These credentials do not match our records.'
                ], 422);
            }
            $user = auth()->user();
            $auth_token = $user->createToken('my-app-token')->plainTextToken;
            $response_data['user'] = new UserResource($user);
            $response_data['token'] = ['auth_token' => $auth_token];
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Login");
        }
        return $this->apiResponse('202', "Login Done" , $response_data);
    }

    public  function logout(Request $request){
        try {
            DB::beginTransaction();
            $user['user'] =auth()->user() ;
            $request->user()->currentAccessToken()->delete();
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Not Logout");
        }
        return $this->apiResponse('202', "You have been successfully logged out.");
    }

    public  function profile(){
        try {
            DB::beginTransaction();
            $user['user'] =new UserResource(auth()->user()) ;
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->apiResponse('404', "Profile Not Found");
        }
        return $this->apiResponse('202', "Register Done" , $user);
    }


}
