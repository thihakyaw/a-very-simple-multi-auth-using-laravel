<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function __construct(Request $request)
    {

        
    }

    public function register(Request $request)
    {
        //VALIDATION HERE

        $admin = Admin::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>bcrypt($request['password']),
        ]);
        //REGISTER NEW USER BY RECORDING NAME, PHONE 
        return response()->json([
            'status_code'=>200,
            'message'=>'Admin registered successfully.',
            'data'=>[
                
            ]
        ]);
    }

    public function login(Request $request)
    {
        //VALIDATE PHONE NUMBER

        $admin = Admin::where('email',$request->email)->first();

        if(!$admin){
            return response()->json([
                'status_code'=>404  ,
                'message'=>'Admin does not exist.',
                'data'=>[
                    
                ]
            ]);
        }

        if(!Hash::check($request->password,$admin->password)){
            return response()->json([
                'status_code'=>401  ,
                'message'=>'Incorrect password',
                'data'=>[
                    
                ]
            ]);
        }

        $admin->OauthAcessToken()->where('name','admin')->delete();
        $access_token = $admin->createToken('admin',['admin'])->accessToken;
        //LOGIN

        //RETURN DATA WITH access_TOKEN
        return response()->json([
            'status_code'=>200 ,
            'message'=>'Admin has successfully logged in OTP.',
            'data'=>[
                'admin'=>$admin,
                'access_token'=>$access_token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->OauthAcessToken()->where('name','admin')->delete();

        return response()->json([
            'status_code'=>200 ,
            'message'=>'Logout successful.',
            'data'=>[

            ]
        ]);
    }

    public function getAllPosts(Request $request)
    {
        $posts = Post::get();
        return response()->json([
            'status_code' => 200,
            'message' => "All posts retrieved successfully.",
            'data' => [
                "post"=>$posts,
            ],
        ]);

    }


    
}
