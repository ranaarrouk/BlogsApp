<?php


namespace App\DataTransferObjects;


use Spatie\DataTransferObject\DataTransferObject;

class StoreBlogDTO extends DataTransferObject
{
    public string $title;

    public $content;

    public $image;

    public string $status;

    public string $publishDate;

    /**
     * StoreBlogDTO constructor.
     * @param string $title
     * @param $content
     * @param $image
     * @param string $status
     * @param string $publishDate
     */
    public function __construct(string $title, $content, $image, string $status, string $publishDate)
    {
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->status = $status;
        $this->publishDate = $publishDate;
    }


}
