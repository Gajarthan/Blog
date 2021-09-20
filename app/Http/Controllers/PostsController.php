<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Posts;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Routing\Redirector;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Posts::orderBy('updated_at','DESC')->get();
        return view('admin.posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $activity = Posts::create([
            'title'=>'untitled',
            'description'=>null,
            'slug'=>null,
            //'image_path'=>$newImageName,
            'categoryId'=>null,
            'userId'=>auth()->user()->id
        ]);

        $dropdown = Categories::all();
        //        dd($//dropdown);
        return view('admin.posts.CreateAndUpdate')->with('post',['ep'=>$activity,'cd'=>$dropdown,'id'=>$activity->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
       // dd($request->contant);
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'categoryId'=>'required'
        ]);

        Posts::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=>SlugService::createSlug(Posts::class,'slug',$request->title),
            //'image_path'=>$newImageName,
            'categoryId'=>$request->categoryId,
            'userId'=>auth()->user()->id
        ]);

        return redirect('/admin/posts')->with('message','Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        return view('blog.show')->with('post',Posts::where('id',$id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $dropdown = Categories::all();
        $editdata = Posts::where('slug',$id)->first();
        return view('admin.posts.CreateAndUpdate')->with('post',['ep'=>$editdata,'cd'=>$dropdown,'id'=>'']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Posts::where('id',$id)->update([
            'title'=>$request->input('title'),
            'decription'=>$request->input('decription'),
            'slug'=>SlugService::createSlug(Posts::class,'slug',$request->title),
            //'image_path'=>$newImageName,
            'user_id'=>auth()->user()->id
        ]);

        return redirect('/blog')->with('message','Your post has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $post = Posts::where('slug',$id);
        $post->delete();

        return redirect('/blog')->with('message','your post has been deleted!');
    }

    public function home(){
        $posts = Posts::orderBy('updated_at','DESC')->first();
        return view('index')->with('posts', $posts);
    }



}
