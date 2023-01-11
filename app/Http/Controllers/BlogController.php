<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlog;
use App\Http\Requests\UpdateBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function __construct()
    {
//        $this->middleware('');
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $storeRequest = new StoreBlog();
        $validator = Validator::make($request->all(), $storeRequest->rules(), $storeRequest->messages());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {

            $imageName = "";
            if ($request->hasFile('image')) {
                $file = $request->image;
                $file->store('public\blogs');
                $imageName = $file->hashName();
            }

            $blog = Blog::create([
                'title' => $request["title"],
                'content' => $request["content"],
                'image' => $imageName,
                'status' => $request["status"],
                'publish_date' => $request["publish_date"],
            ]);
            $blog->refresh();

            return response()->json("Blog added successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function edit($blog)
    {
        $blog = Blog::findOrFail($blog);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $blog)
    {
        $updateRequest = new UpdateBlog();
        $validator = Validator::make($request->all(), $updateRequest->rules(), $updateRequest->messages());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {

            $image = "";

            Blog::find($blog)->update([
                'title' => $request["title"],
                'content' => $request["content"],
                'image' => $image,
                'status' => $request["status"],
                'publish_date' => $request["publish_date"],
            ]);

            return response()->json("Blog updated successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function destroy($blog)
    {
        try {
            Blog::find($blog)->delete();
            return response()->json("Blog deleted successfully", 200);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

}
