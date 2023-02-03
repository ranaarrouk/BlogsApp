<?php


namespace App\Actions;


use App\DataTransferObjects\StoreBlogDTO;
use App\Models\Blog;
use Illuminate\Http\Request;

class UpdateBlogAction
{
    public function execute(StoreBlogDTO $storeBlogDTO, $blog)
    {
        $blog = Blog::find($blog);
        $blog->update([
            'title' => $storeBlogDTO->title,
            'content' => $storeBlogDTO->content,
            'image' => empty($storeBlogDTO->image)? $blog->image : $storeBlogDTO->image,
            'status' => $storeBlogDTO->status,
            'publish_date' => $storeBlogDTO->publishDate,
        ]);

    }
}
