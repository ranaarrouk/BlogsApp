<?php


namespace App\Actions;


use App\DataTransferObjects\StoreBlogDTO;
use App\Models\Blog;
use Illuminate\Http\Request;

class StoreBlogAction
{
    public function execute(StoreBlogDTO $storeBlogDTO): void
    {
        $imageName = "";
        if (request()->hasFile('image')) {
            $file = $storeBlogDTO->image;
            $file->store('public\blogs\images');
            $imageName = $file->hashName();
        }

        $blog = Blog::create([
            'title' => $storeBlogDTO->title,
            'content' => $storeBlogDTO->content,
            'image' => $imageName,
            'status' => $storeBlogDTO->status,
            'publish_date' => $storeBlogDTO->publishDate,
        ]);
        $blog->refresh();
    }
}
