<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Enums\UserRole;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if(!Auth::guard('web')->attempt($request->only('email', 'password'))){
                return response()->json([
                    'message' => 'Unauthorized',
                    'data' => null,
                ], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login Success!',
                'data' => [
                    'token' => $token,
                    'user' => new UserResource($user),
                ],
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'Terjadi Kesalahan saat login!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function me()
    {
        try{
            $user = Auth::user();

            return response()->json([
                'message' => 'User Profile taken succesfully.',
                'data' => new UserResource($user),
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Terjadi Kesalahan!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try{
            $user = Auth::user();
            // if($user->currentAccessToken()){
              $user->currentAccessToken()->delete();
            // }else{
            //   auth()->guard('web')->logout();
            //   $request->session()->invalidate();
            //   $request->session()->regenerateToken();
            // }

            return response()->json([
                'message' => 'Logout succesfully.',
                'data' => null,
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Terjadi Kesalahan!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function register(RegisterStoreRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try{
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->role = UserRole::user;
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'message' => 'Register succesfully.',
                'data' => [
                    'token' => $token,
                    'user' => new UserResource($user),
                ],
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Terjadi kesalahan saat register!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
