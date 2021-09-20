<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $categories = Categories::orderBy('updated_at','DESC')->Paginate(5);
        $dropdown = Categories::pluck('name', 'id');
        return view('admin.category.index')->with('data', ['ca'=>$categories, 'ec'=>null,'cd'=>$dropdown]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
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
     * @param Categories $categories
     * @return void
     */
    public function show(Categories $categories)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $edit_category = Categories::find($id);
        $categories = Categories::orderBy('updated_at','DESC')->Paginate(5);
        $categories_drop = Categories::orderBy('name','DESC');
        return view('admin.category.index')->with('data', ['ec' => $edit_category, 'ca' => $categories, 'cd'=>$categories_drop]);
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
        Categories::where('id',$id)->update([
            'name'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=>SlugService::createSlug(Posts::class,'slug',$request->slug),
           // 'image_path'=>$newImageName,
        //    'user_id'=>auth()->user()->id
        ]);

        return redirect('/admin/categories')->with('message','Your post has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $categories=Categories::find($id);
        $categories->delete();
        return redirect('/admin/categories')->with('success', 'Product deleted successfully');
    }
}
