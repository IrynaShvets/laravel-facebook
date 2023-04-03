<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validator = Validator::make($request->all());
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }
        
        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                
            ]);
           
            if ($request->hasFile('image')) {
                $destination_path = 'images';
                $image = $request->file('image');
                $image_name = date('d-m-Y')."_".$image->getClientOriginalName();           
                $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
                $user->image = $path;
                Storage::disk('s3')->put($path, file_get_contents($image));
            }
            
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'email' => 'Authentication email or password is not valid.',
                'password' => 'Authentication email or password is not valid.'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    /**
     * Logout
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Logged out']);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out']);
    }

    // public function getUser(Request $request)
    // {
    //     return $request->user();
    // }

    public function getUser()
    {
        if (Auth::check()) {
            return new UserResource(Auth::user());
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 404);
        }
    }

    public function uploadImage(Request $request){
        if($request->hasfile('image')){
            return "Yes";
        }
        else{return "No";}
    }

}
