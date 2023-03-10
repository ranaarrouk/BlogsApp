<?php

namespace App\Http\Controllers;

use App\Actions\StoreBlogAction;
use App\Actions\UpdateBlogAction;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $blogs = Blog::query()->select(['id', 'image', 'title', 'publish_date', 'status']);
            return DataTables::of($blogs)->addIndexColumn()
                ->addColumn('image', function ($blog) {
                    $url = asset('storage/blogs/images/' . $blog->image);
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })->addColumn('action', function ($blog) {
                    $route = url('blogs/' . $blog->id);
                    $btn = '<a href="' . route('blogs.show', $blog->id) . '" class="m-1 btn btn-primary btn-sm">View</a>';
                    $btn .= '<a href="' . route('blogs.edit', $blog->id) . '"  class="btn-secondary m-1  btn btn-sm edit-blog">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" data-url="' . $route . '" class="btn-danger btn btn-sm delete-blog">Delete</a>';
                    return $btn;
                })->filter(function ($instance) use ($request) {
                    if ($request->get('status'))
                        $instance->where('status', $request->get('status'));

                    if ($request->get('publish_date'))
                        $instance->where('publish_date', $request->get('publish_date'));

                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('title', 'LIKE', "%$search%")
                                ->orWhere('content', 'LIKE', "%$search%");
                        });
                    }})
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.blogs.index');
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request, StoreBlogAction $storeBlogAction)
    {
        try {
            $storeBlogAction->execute($request->toDto());
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

    public function update(UpdateBlogRequest $updateBlogRequest, UpdateBlogAction $updateBlogAction, $blog)
    {
        try {
            $updateBlogAction->execute($updateBlogRequest->toDto(), $blog);
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

    public function show($blog)
    {
        $blog = Blog::findOrFail($blog);
        return view('admin.blogs.show', compact('blog'));
    }

}
