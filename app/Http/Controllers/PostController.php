<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        Carbon::setLocale('fr');

        $posts = Post::latest()->paginate(8);
               
        foreach ($posts as $post){

            // get user how made a post 
            $post->setAttribute('user',$post->user);
            // get user how made a post 
            $post->setAttribute('category',$post->category->name);
            // parse date 
            $post->setAttribute('added',Carbon::parse($post->created_at)->diffForHumans());
            // get the slug 
            $post->setAttribute('path','/post/'.$post->slug);
        }
        // send data 
        return response()->json($posts);
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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store an image inside public directory
        $name = null;
        if($request->hasFile('image')){
            $name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$name);
        }

        // $url = explode('/',url()->current());
        // Post::create([
        //     "title"=>$request->title,
        //     "slug"=>Str::slug($request->title),
        //     "body"=>$request->body,
        //     "photo"=>$url[0].'/images/'.$name,
        //     "user_id"=>$request->user_id,
        //     "category_id"=>$request->category_id,
          
            
        // ]);
        $post = new Post();
        $post->title = $request->title;
        $post->slug =Str::slug($request->title);
        $post->body = $request->body;
        $post->photo ='/images/'.$name;
        // $post->user_id = $request->user_id;
        $post->user_id = 8;
        $post->category_id = $request->category_id;

        $post->save();

        return response()->json([
            "message"=> "Post bien ajouté"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        Carbon::setLocale('fr');

        return response()->json([

            'id'=> $post->id,
            'title'=> $post->title,
            'photo'=> $post->photo,
            'body'=> $post->body,
            'created_at'=>Carbon::parse($post->created_at)->diffForHumans(),
            'user'=> auth()->check() ?  $post->user->name :  '',
            // 'category'=> $post->catgeory->name,
            'comments_count'=> $post->comments->count(),
            'comments'=>$this->commentsArray($post->comments)
        ]);
    }
    public function commentsArray($comments){
        $jsonComments = [] ;

        foreach($comments as $comment){
            array_push($jsonComments,[
                'id'=>$comment->id,
                'body'=>$comment->body,
                'created_at'=>$comment->created_at,
                'user'=> $comment->user ?  $comment->user->name  : '',
            ]);
        }

        return  $jsonComments ;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $name = null;
        $photo = $post->photo;
        if($request->hasFile('image')){
            
            $name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$name);
            $photo = "/images/"+ $name;

        }

        $post->update([
                "title"=>$request->title,
                "slug"=>Str::slug($request->title),
                "body"=>$request->body,
                "photo"=>$photo,
                "user_id"=>$request->user_id,
                "category_id"=>$request->category_id
        ]);

        return response()->json([
            "message" =>"post est bien modifié"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        return response()->json([
            "message" => "post est bien supprimé!"
        ]);
    }
    public function category($slug){

        Carbon::setLocale('fr');

        $category = Category::where('slug',$slug)->first();
        $posts    = Post::where('category_id',$category->id)->get();
        // $posts    = Post::find($category->id);
   

        foreach ($posts as $post){
            $post->setAttribute('user',$post->user);
            $post->setAttribute('added',Carbon::parse($post->created_at)->diffForHumans());
            $post->setAttribute('path','/post/',$post->slug);
        }

        return response()->json($posts);
    }
}
