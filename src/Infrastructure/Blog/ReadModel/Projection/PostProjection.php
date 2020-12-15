<?php
declare(strict_types=1);

namespace App\Infrastructure\Blog\ReadModel\Projection;


use App\Domain\Blog\Event\PostWasCreated;
use App\Infrastructure\Blog\ReadModel\PostView;
use App\Infrastructure\Blog\ReadModel\Repository\MDBPostRepository;
use Broadway\ReadModel\MongoDB\MongoDBRepository;
use Broadway\ReadModel\MongoDB\MongoDBRepositoryFactory;
use Broadway\ReadModel\Projector;

class PostProjection extends Projector
{
    /**
     * @var MongoDBRepository
     */
    private $repository;

    public function __construct(MDBPostRepository $repository)
    {
        $this->repository = $repository;
    }
    protected function applyPostWasCreated(PostWasCreated $event)
    {
        $post = PostView::fromSerializable($event);

        $this->repository->save($post);
    }
}