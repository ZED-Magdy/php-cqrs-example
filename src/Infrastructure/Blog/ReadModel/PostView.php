<?php
declare(strict_types=1);

namespace App\Infrastructure\Blog\ReadModel;

use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostTitle;
use Broadway\ReadModel\SerializableReadModel;
use Broadway\Serializer\Serializable;

class PostView implements SerializableReadModel
{

    private $postId;
    private $postTitle;
    private $postContent;

    private function __construct(PostId $postId, PostTitle $postTitle, PostContent $postContent)
    {
        $this->postId = $postId;
        $this->postTitle = $postTitle;
        $this->postContent = $postContent;
    }

    public static function fromSerializable(Serializable $event): self
    {
        return self::deserialize($event->serialize());
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

    public function getId(): string
    {
        return $this->id()->id();
    }
}