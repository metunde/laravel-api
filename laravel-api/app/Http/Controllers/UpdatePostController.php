<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class UpdatePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json(['msg' => 'updated successfully']);
    }
}
