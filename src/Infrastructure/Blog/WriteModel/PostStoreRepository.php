<?php
declare(strict_types=1);

namespace App\Infrastructure\Blog\WriteModel;


use App\Domain\Blog\Entity\Post;
use App\Domain\Blog\ValueObject\PostId;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

final class PostStoreRepository extends EventSourcingRepository
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            Post::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

    public function store(Post $model): void
    {
        $this->save($model);
    }

    public function findOneBy(PostId $id)
    {
        $model = $this->load($id->id()->toString());

        return $model;
    }

}