<?php


namespace App\Application\Query\Handler;


use App\Application\Query\ListPostsQuery;
use App\Infrastructure\Blog\ReadModel\Repository\MDBPostRepository;

class ListPostsQueryHandler
{
    /**
     * @var MDBPostRepository
     */
    private MDBPostRepository $repository;

    public function __construct(MDBPostRepository $repository)
    {

        $this->repository = $repository;
    }

    public function __invoke(ListPostsQuery $query)
    {
        return $this->repository->findAll();
    }
}