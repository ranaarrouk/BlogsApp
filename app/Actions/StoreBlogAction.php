<?php


namespace App\Actions;


use App\Models\Blog;
use Illuminate\Http\Request;

class StoreBlogAction
{
    public function execute(Request $request): void
    {
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
    }
}
