<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=> 'required|exists:categories,id',
            'title' => 'required|min:3|max:20',
            'author' => 'required|min:3|max:20',
            'tags' => 'required',
            'content' => 'required|min:4|string',
            'status' => 'required|min:4',
            'image' => 'required|mimes:jpg,png,jpeg,max:5048'
        ]);

        $img_name = time() . '-' . str_replace(' ', '', $request->title) . '.' .$request->image->extension();
        $request->image->move(public_path('img/posts'), $img_name);

        $post = new Post();
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->author = trim($request->author);
        $post->content = $request->content;
        $post->tags = $request->tags;
        $post->status = $request->status;
        $post->date = date('d-m-y');
        $post->image = $img_name;
        $post->save();
        return Response()->json(['message'=>'Added Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
