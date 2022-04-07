<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => "List of users",
            'data' => User::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        #validation
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'name' => 'required', 'string', 'max:255',
            'firstname' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'confirmed',
            'age' => 'required', 'integer',
        ]);
        #if failed
        if ($validator->fails()) {
            return response()->json([
                'message' => "Empty field ! ",
            ], 400);
        }
        #create user by the validator 
        else {
            $user = User::create([
                'username' => $request['username'],
                'name' => $request['name'],
                'firstname' => $request['firstname'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'age' => $request['age'],
            ]);

            // $token = $user->createToken('usertoken')->plainTextToken;

            return response()->json([
                'message' => "This user is created",
                'data' => $user,
                // 'token' => $token
            ], 201);
        }
    }
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => "empty field",
    //         ], 400);
    //     }  
    //     else {
    //         if (!$user || !Hash::check($request->password, $user->password)) {
    //             return response()->json([
    //                 'message' => "Wrong inputs",
    //             ], 400);
    //         } else {
    //             if(Auth::attempt($validator)){
    //                 $token = auth()->user()->createToken('usertoken')->plainTextToken;
    //                 return response()->json([
    //                     'token'=> $token
    //                 ], 201); 
    //             }
    //         }
    //     }
    // }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('API_Token')->plainTextToken;
            return response()->json([
                'message' => 'User logged',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'error occured'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => "Logged out !"
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user == NULL) {
            return response()->json([
                'message' => "User not found !",
            ], 400);
        } else {
            return response()->json([
                'message' => "User found.",
                'data' => $user
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
