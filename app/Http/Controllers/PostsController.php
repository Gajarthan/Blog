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
        return view('admin.posts.CreateAndUpdate');
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
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($slug)
    {
        $post = Posts::where('slug',$slug);
        $post->delete();

        return redirect('/blog')->with('message','your post has been deleted!');
    }

    public function fileupload(){
        $accepted_origins = array("http://127.0.0.1:8000/");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "images/";

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
                return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        reset ($_FILES);
        $temp = current($_FILES);
        dd($temp);
        if (is_uploaded_file($temp['tmp_name'])){
            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Determine the base URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
            $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => $baseurl . $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }
}
