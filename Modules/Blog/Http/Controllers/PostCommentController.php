<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostComment;

class PostCommentController extends Controller
{
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
        ->with('comments', 'comments.user')
        ->withCount('comments')
        ->first();
        
        return view('blog::comments.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);
        $comment = PostComment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();
        flashSuccess('Comment edited successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $comment = PostComment::findOrFail($id);
        $comment->delete();
        flashSuccess('Comment deleted successfully.');
        return back();
    }
}
