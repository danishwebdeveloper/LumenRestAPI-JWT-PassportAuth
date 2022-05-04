<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $posts = Post::all();
        return $this->successResponse($posts);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
        ];
        $this->validate($request, $rules);
        $post = Post::create($request->all());
        $post->save();
        return $this->successResponse($post, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
        ];
        $this->validate($request, $rules);

        $post = Post::findOrFail($id);
        $post->fill($request->all());
        if ($post->isClean()) {
            return $this->errorResponse('At least one Field should be changed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $post->update($request->all());
        // return $this->successResponse([$post, 'message' => 'Post updated successfully']);
        return $this->successResponse($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $this->successResponse([$post, 'message' => 'Deleted Successfully']);
    }
}
