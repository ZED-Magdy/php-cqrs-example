<?php

declare(strict_types=1);

namespace App\Domain\Blog\Entity;


use App\Domain\Blog\Event\PostWasCreated;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostTitle;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\Uuid;

final class Post extends EventSourcedAggregateRoot
{
    private $postId;
    private $title;
    private $content;

    public static function create(PostId $aPostId, PostTitle $aPostTitle, PostContent $aPostContent): Post
    {
        $post = new self();
        $post->postId = $aPostId;

        $post->apply(new PostWasCreated($aPostId, $aPostTitle, $aPostContent));
        return $post;
    }
    public function getAggregateRootId(): string
    {
        return $this->postId->id();
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