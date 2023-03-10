<?php


namespace App\Actions;


use App\DataTransferObjects\StoreBlogDTO;
use App\Models\Blog;
use Illuminate\Http\Request;

class StoreBlogAction
{
    public function execute(StoreBlogDTO $storeBlogDTO): void
    {
        $blog = Blog::create([
            'title' => $storeBlogDTO->title,
            'content' => $storeBlogDTO->content,
            'image' => $storeBlogDTO->image,
            'status' => $storeBlogDTO->status,
            'publish_date' => $storeBlogDTO->publishDate,
        ]);
        $blog->refresh();
    }
}
