<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = comment::with('post')->get();
        
        return view('admin.comments.view-comments', compact('rows'));
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
            'author' => 'required',
            'email' => 'required',
            'content' => 'required',
        ]);
        $comment = new comment();

        $comment->post_id = $request->post_id;
        $comment->author = $request->author;
        $comment->email = $request->email;
        $comment->content = $request->content;
        $comment->date = date('d-m-y');

        $comment->save();
        return Response()->json(['message'=>'Comment Sent Wait To Approving']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approving($id)
    {
        $comment = comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        
        if($comment->status != 'approved'){
            $post->comment_counts = $post->comment_counts + 1;
            $post->save();
        }

        $comment->status = 'approved';
        $comment->save();
    

        return response()->json(['message' => 'approved', 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unapproving($id)
    {
       $comment = comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        
        if($comment->status != 'unapproved'){
            $post->comment_counts = $post->comment_counts - 1;
            $post->save();
        }
        
        $comment->status = 'unapproved';
        $comment->save();
    

        return response()->json(['message' => 'unapproved', 'id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
        comment::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted Success', 'id' => $id]);
        
    }
}
