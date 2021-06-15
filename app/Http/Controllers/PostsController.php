<?php

namespace App\Http\Controllers;

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

        return view('blog.index')->with('posts', Posts::orderBy('updated_at','DESC')->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'decription'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName=uniqid().'-'.$request->title.'.'.$request->image->extension();

        $request->image->move(storage_path('app/public/image'),$newImageName);


        Posts::create([
            'title'=>$request->input('title'),
            'decription'=>$request->input('decription'),
            'slug'=>SlugService::createSlug(Posts::class,'slug',$request->title),
            'image_path'=>$newImageName,
            'user_id'=>auth()->user()->id
        ]);

        return redirect('/blog')->with('message','Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        return view('blog.show')->with('post',Posts::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post',Posts::where('slug',$slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $slug)
    {
        Posts::where('slug',$slug)->update([
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($slug)
    {
        $post =Posts::where('slug',$slug)->with('message','your post has been deleted!');
    }
}
