<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\PostFormFields;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Post;
use Storage;

class PostController extends Controller
{

    public function __construct() 
    {
        $this->middleware('validator:\App\Post', ['only' => ['store', 'update']]);
        
        $this->middleware('acl:post-show',   ['only' => ['index', 'show']]);
        $this->middleware('acl:post-delete', ['only' => ['destroy']]);
        $this->middleware('acl:post-create', ['only' => ['create', 'store']]);
        $this->middleware('acl:post-edit',   ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Show the new post form
     */
    public function create()
    {
        $data = $this->dispatch(new PostFormFields());

        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created Post
     *
     * @param Request $request
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->postFillData(Post::class));
        if ($request->hasFile('images')) {
            $post->images = $this->uploadImage($request);
            $post->save();
        }
        return redirect()
            ->route('admin.post.index')
            ->withSuccess('New Post Successfully Created.');
    }

    /**
     * Show the post edit form
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try{
            $data = $this->dispatch(new PostFormFields($id));
            return view('admin.post.edit', $data);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }

    /**
     * Update the Post
     *
     * @param Request $request
     * @param int  $id
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $images = $post->images;
        $post->fill($request->postFillData(Post::class));

        if ($request->hasFile('images')) {
            // delete file
            $path = $this->getPath();
            if ($images && \File::exists($path . $images)) {
                \File::delete($path . $images);
                \File::delete($path . 'thumb/' . $images);
            }
            $post->images = $this->uploadImage($request);
        } else {
            $post->images = $images;
        }

        $post->save();

        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->withSuccess('Post saved.');
        }

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post deleted.');
    }


    private function getPath() {
        $path = public_path('uploads')."/";
        return $path;
    }

    private function uploadImage($request)
    {
        $imageName = '';
        if ($request->hasFile('images')) {
            $imageName = md5($request->file('images')->getClientOriginalName()) . '.' .
                $request->file('images')->getClientOriginalExtension();

            $path = $this->getPath();
            $image = \Image::make($request->file('images'));
            $image->save(sprintf($path . '%s', $imageName));
            $image->resize(243, 139)->save(sprintf($path . 'thumb/%s', $imageName));
        }
        return $imageName;
    }
}
