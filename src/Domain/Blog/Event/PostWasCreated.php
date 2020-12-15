<?php
declare(strict_types=1);

namespace App\Domain\Blog\Event;


use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostTitle;
use Broadway\Serializer\Serializable;

final class PostWasCreated implements Serializable
{
    private $postId;
    private $postTitle;
    private $postContent;

    public function __construct(PostId $postId, PostTitle $postTitle, PostContent $postContent)
    {
        $this->postId = $postId;
        $this->postTitle = $postTitle;
        $this->postContent = $postContent;
    }

    public function id(): PostId
    {
        return $this->postId;
    }

    public function title(): PostTitle
    {
        return $this->postTitle;
    }

    public function content(): PostContent
    {
        return $this->postContent;
    }

    public static function deserialize(array $data)
    {
        return new self(
            PostId::fromString($data['id']),
            PostTitle::fromString($data['title']),
            PostContent::fromString($data['content'])
        );
    }

    public function serialize(): array
    {
        return [
          'id' => $this->id()->id(),
          'title' => $this->title()->title(),
          'content' => $this->content()->content()
        ];
    }
}