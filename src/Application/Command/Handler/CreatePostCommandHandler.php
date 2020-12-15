<?php


namespace App\Application\Command\Handler;

use App\Application\Command\CreatePostCommand;
use App\Domain\Blog\Entity\Post;
use App\Infrastructure\Blog\WriteModel\PostStoreRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatePostCommandHandler implements MessageHandlerInterface
{
    /**
     * @var PostStoreRepository
     */
    private $repository;

    public function __construct(PostStoreRepository $repository)
    {

        $this->repository = $repository;
    }
    public function __invoke(CreatePostCommand $command)
    {
        $post = Post::create(
            $command->id(),
            $command->title(),
            $command->content()
        );

        $this->repository->store($post);
    }
}