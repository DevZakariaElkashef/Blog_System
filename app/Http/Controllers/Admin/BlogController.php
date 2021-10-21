<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Symfony\Component\CssSelector\Node\FunctionNode;

class BlogController extends Controller
{
    public function index(){

        $posts = Post::where('status', '=', 'published')->paginate(6, ['*'], 'posts');
        $cats = Category::paginate(58, ['*'], 'categories');
        

        if(count(Post::all()) > 1 && count($cats) > 1){
            $rand = rand(0, (count(Post::all())-1));
            $rand_post =  Post::all()[$rand];
            return view('blog.index', compact('posts', 'cats', 'rand_post'));
        }
        return view('blog.index', compact('posts' ,'cats'));

    }

    public function search(Request $request){
        $request->validate([
            'search' => 'required'
        ]);
        $rows = Post::where('title', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('tags', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('author', 'LIKE', '%'.$request->search.'%')->get();
        $cats = Category::paginate(50);
        return view('blog.search', compact('rows', 'cats'));

    }
}
