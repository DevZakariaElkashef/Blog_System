<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminPage (){
        $this->authorize('admins');
        
        $tables = [
            'cat' => Category::all(), 
            'post' => Post::all(),
            'user' => User::all(),
            'comment' => comment::all()
        ];
    
        $cats       = count($tables['cat']);
        $posts      = count($tables['post']);
        $users      = count($tables['user']);
        $comments   = count($tables['comment']);

        return view('admin.index', compact('cats', 'posts', 'users', 'comments'));
    }
   
   
    public function blogPage (){
        return view('blog.index');
    }
    
    
}
