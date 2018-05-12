<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex(Store $session)
    {
        $posts = Post::all();
        return view('blog.index')->with('posts', $posts);
    }

    public function getAdminIndex(Store $session)
    {
        $posts = Post::all();
        $tags = Tag::all();
        return view('admin.index')->with('posts', $posts)->with('tags', $tags);         
    }

    public function getPost(Store $session, $id)
    {
        $post = Post::find($id);
        return view('blog.post')->with("post", $post);
    }

    public function postLike($id){
        $post = Post::find($id);
        $like = $post->likes()->first();
        $like->count++;
        $post->likes()->save($like);

        return redirect()->route("blog.index");
    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        if($tags->count()>0)
            return view('admin.create')->with("tags", $tags);
        else
            return redirect()->route("admin.tag.create")->with("info", "No Tags Yet! Create one!");
    }

    public function getAdminEdit(Store $session, $id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view("admin.edit")->with('post', $post)->with('tags', $tags);
    }

    public function postAdminCreate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'tag' => 'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        
        $like = new Like();
        $post->likes()->save($like);

        $post->tags()->attach($request->tag);

        return redirect()->route("admin.index")->with('info', 'Post createde, Title is: '.$request->title);
    }

    public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $post->tags()->detach();
        foreach($request->tag as $tag){
            $new_tag = Tag::find($tag);
            $post->tags()->attach($new_tag);  
        }

        return redirect()->route('admin.index')->with('info', "Post edited, new Title is: ".$request->title);
    }

    public function postAdminDelete(Store $session, $id){
        $post = Post::find($id);

        $post->tags()->detach();
        $post->likes()->first()->delete();

        $post->likes()->delete();
        $post->delete();

        return redirect()->route('admin.index')->with('info', "Post deleted, Title is: ".$post->title);
    }

    public function tagGetAdminCreate(){
        return view("admin.tags.create");
    }

    public function tagPostAdminCreate(Request $request){
        $tag = new Tag();
        $tag->tag = $request->tag;
        $tag->save();

        return redirect()->route('admin.index')->with('info', "Tag created, Title is: ".$tag->tag);
    }

    public function tagAdminEdit($id){
        $tag = Tag::find($id);
        return view('admin.tags.edit')->with("tag", $tag);
    }

    public function tagAdminUpdate(Request $request, $id){
        $tag = Tag::find($id);
        $tag->tag = $request->tag;
        $tag->save();

        return redirect()->route('admin.index');
    }

    public function tagAdminDelete($id){
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route("admin.index");
    }
}
