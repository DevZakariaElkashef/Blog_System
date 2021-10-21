<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BlukOptoinsController extends Controller
{
    public function commentOption (Request $request) {
        
        foreach($request->checkBoxArray as $commentId){
            
            
            $bulkOptions = $request->bulkoptions;

            switch($bulkOptions){
                case 'approved':
                    $comments = comment::findOrFail($commentId);

                    $post = Post::findOrFail($comments->post_id);
        
                    if($comments->status != 'approved'){
                        $post->comment_counts = $post->comment_counts + 1;
                        $post->save();
                    }

                    $comments->status = $bulkOptions;
                    $comments->save();
                break;
               
                case 'unapproved':
                    $comments = comment::findOrFail($commentId);

                    
                    $post = Post::findOrFail($comments->post_id);
        
                    if($comments->status != 'unapproved'){
                        $post->comment_counts = $post->comment_counts - 1;
                        $post->save();
                    }

                    $comments->status = $bulkOptions;
                    $comments->save();
                break;
               
                case 'delete':
                    $comments = comment::findOrFail($commentId);
                    $comments->delete();
                break;
                
                default:
                return back();
            }

        }
        return back();
    }
    
    
    public function categoriesOptions (Request $request) {
        
      $ids = $request->checkBoxArray;
      $bulkOptions = $request->bulkoptions;
    
        foreach($ids as $id){
            if($bulkOptions == 'delete'){
                $cat = Category::findOrFail($id);
                $cat->delete();
            }
        }
        
        return back();    
    }
    
    public function postsOptions(Request $request) {
        foreach($request->checkBoxArray as $postId){
            
            
            $bulkOptions = $request->bulkoptions;

            switch($bulkOptions){
                case 'published':
                    $posts = Post::findOrFail($postId);
                    $posts->status = $bulkOptions;
                    $posts->save();
                break;
               
                case 'drafted':
                    $posts = Post::findOrFail($postId);
                    $posts->status = $bulkOptions;
                    $posts->save();
                break;
               
                case 'delete':
                    $posts = Post::findOrFail($postId);
                    $posts->delete();
                    break;
                    
                default:
                return back();
            }

        }
        return back();
    }
    
    public function userOptions (Request $request) {
        
        foreach($request->checkBoxArray as $userId){
            
            
            $bulkOptions = $request->bulkoptions;
    
            switch($bulkOptions){
                case 'delete':
                    $users = User::findOrFail($userId);
                    $users->delete();
                break;
                
                default:
                return back();
            }
    
        }
        return back();
    }
}
