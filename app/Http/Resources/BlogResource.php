<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "content" => $this->content,
            "image_path" => asset('storage/blogs/images/' . $this->image),
            "publish_date" => $this->publish_date,
        ];
    }
}
