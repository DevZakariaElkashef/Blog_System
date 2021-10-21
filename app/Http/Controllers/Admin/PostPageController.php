<?php

namespace App\Http\Controllers\Admin;

use App\Events\AddViewerEvent;
use App\Http\Controllers\Controller;
use App\Listeners\AddViewerListener;
use App\Models\Category;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostPageController extends Controller
{
    public function show($id)
    {
        event(new AddViewerEvent($id));
        $post = Post::findOrFail($id);
        $cats = Category::paginate(58, ['*'], 'categories'); 
        $comments = comment::where('post_id', '=', $id)->where('status', '=', 'approved')->get();
        
        
        return view('post.index', compact('post', 'cats', 'comments'));
    }
    public function author($author){
        $rows = Post::where('author', '=', $author)->get();
        $cats = Category::paginate(50);
        $author = $author;
        return view('post.author', compact('cats', 'rows', 'author'));
    }

    public function category($catId){
        $rows = Post::where('category_id', '=', $catId)->get();
        $cats = Category::paginate(50);
        $cat_name = Category::findOrFail($catId)->name;
        return view('post.category', compact('rows', 'cats', 'cat_name'));
    }
}
