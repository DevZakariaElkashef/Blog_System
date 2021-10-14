<?php

namespace App\Listeners;

use App\Events\AddViewerEvent;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddViewerListener
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
     * @param  AddViewerEvent  $event
     * @return void
     */
    public function handle($id)
    {
        $id = $id->id;
        $post = Post::findOrFail($id);
        $post->views = $post->views + 1;
        $post->save();
    }
}
