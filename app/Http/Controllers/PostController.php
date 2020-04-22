<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return response()->json([
            'status_code' => 200,
            'message' => "User posts retrieved successfully.",
            'data' => [
                "post"=>$request->user()->posts()->get(),
            ],
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDATION HERE 

        //CREATE
        $post = Post::create([
            'user_id'=>$request->user()->id,
            'title'=>$request['title'],
            'description'=>$request['description']
        ]);

        
        return response()->json([
            'status_code' => 200,
            'message' => "Post created successfully.",
            'data' => [
                "post"=>$post,
            ],
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $query = $request->user()->posts()->where('id',$request->id)->first();
        
        if(empty($query)){
            return response()->json([
                'status_code' => 404,
                'message' => "Post not found.",
                'data' => [
                
                ],
            ]);
        }

        //DELETING ROW    
        $query->delete();
        return response()->json([
            'status_code' => 200,
            'message' => "Post removed successfully.",
            'data' => [

            ],
        ]);
    }
}
