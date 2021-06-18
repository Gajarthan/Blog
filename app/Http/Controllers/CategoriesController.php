<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.category.index')->with('categories', Categories::orderBy('updated_at','DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $slug = SlugService::createSlug(Categories::class,'slug',$request->title);
        $newImageName="C-".uniqid().'-'.$slug.'.'.$request->image->extension();
        $request->image->move(storage_path('app/public/image'),$newImageName);
        dd(auth()->user()->id);

        Categories::create([
            'name'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=>$slug,
            'imagePath'=>$newImageName,
            'userId'=>auth()->user()->getAuthIdentifier()
        ]);

        return redirect('/admin/categories')->with('message','Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Categories  $categories
     * @return Response
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return Response
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
