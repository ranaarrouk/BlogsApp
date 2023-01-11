<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlog;
use App\Http\Requests\UpdateBlog;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
//        $this->middleware('');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $blogs = Blog::query()->select(['image', 'title', 'publish_date', 'status']);
            return DataTables::of($blogs)->addIndexColumn()
                ->addColumn('image', function ($blog) {
                    $url= asset('storage/blogs/images/'.$blog->image);
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }

        return view('admin.blogs.index');
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
                $file->store('public\blogs\images');
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
