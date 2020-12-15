<?php


namespace App\Infrastructure\Blog\ReadModel\Repository;


use App\Domain\Blog\ValueObject\PostId;
use App\Infrastructure\Blog\ReadModel\PostView;
use Broadway\ReadModel\MongoDB\MongoDBRepositoryFactory;

class MDBPostRepository
{
    private $repository;

    public function __construct(MongoDBRepositoryFactory $factory)
    {
        $this->repository = $factory->create('read_models', PostView::class);
    }

    public function find(PostId $postId)
    {
        return $this->repository->find($postId->id());
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function save(PostView $post)
    {
        $this->repository->save($post);
    }
}