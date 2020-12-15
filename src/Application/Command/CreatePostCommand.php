<?php


namespace App\Application\Command;


use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostTitle;

class CreatePostCommand
{
    private $postId;
    private $title;
    private $content;

    public function __construct(PostId $postId, PostTitle $title, PostContent $content)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
    }

    public function id()
    {
        return $this->postId;
    }

    public function title(): PostTitle
    {
        return $this->title;
    }

    public function content(): PostContent
    {
        return $this->content;
    }
}