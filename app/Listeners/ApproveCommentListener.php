<?php

namespace App\Listeners;

use App\Events\ApproveCommentEvent;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApproveCommentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApproveCommentEvent  $event
     * @return void
     */
    public function handle(ApproveCommentEvent $event, $id)
    {
        $comment = comment::findOrFail($id);
        
        if($comment->status != 'unapproved'){
            $post = Post::findOrFail($comment->post_id);
            $post->comment_counts = $post->comment_counts + 1;
            $post->save();
        }
    }
}
