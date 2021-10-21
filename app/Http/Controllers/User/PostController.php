<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $rows = Post::where('user_id', '=', $id)->paginate(3);
        $cats = Category::all();
        
        return view('user.view-posts', compact('rows' ,'cats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $cats = Category::all();
        return view('user.edit-post', compact('post' ,'cats'));
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
        $request->validate([
            'category_id'=> 'required|exists:categories,id',
            'title' => 'required|min:3|max:20',
            'author' => 'required|min:3|max:20',
            'tags' => 'required',
            'content' => 'required|min:4|string',
            'status' => 'required|min:4',
            'image' => 'nullable|mimes:jpg,png,jpeg,max:5048'
        ]);
        
        $post = Post::findOrFail($id);
        if($request->hasFile('image')){
            $img_name = time() . '-' . str_replace(' ', '', $request->title) . '.' .$request->image->extension();
            $request->image->move(public_path('img/posts'), $img_name);
            $post->image = $img_name;
        }
        
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->tags = $request->tags;
        $post->status = $request->status;
        $post->date = date('d-m-y');
        $post->content = $request->content;
        $post->views = 0;
        $post->save();
        return Response()->json(['message'=>'Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findORFail($id)->delete();
        return Response()->json(['message'=>'Deleted Success', 'id'=>$id]);
    }
}
