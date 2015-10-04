<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\PostFormFields;
use App\Http\Requests;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Controllers\Controller;
use App\Post;
use Storage;

class PostController extends Controller
{
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
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
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
        $data = $this->dispatch(new PostFormFields($id));

        return view('admin.post.edit', $data);
    }

    /**
     * Update the Post
     *
     * @param PostUpdateRequest $request
     * @param int  $id
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $images = $post->images;
        $post->fill($request->postFillData());

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
