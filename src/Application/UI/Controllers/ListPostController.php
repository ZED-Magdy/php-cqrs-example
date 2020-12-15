<?php


namespace App\Application\UI\Controllers;

use App\Application\Query\ListPostsQuery;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class ListPostController extends AbstractController
{
    private $bus;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(MessageBusInterface $queryBus, SerializerInterface $serializer)
    {

        $this->bus = $queryBus;
        $this->serializer = $serializer;
    }
    /**
     * @Route(path="/", methods={"GET"})
     */
    public function __invoke()
    {
        $posts = $this->bus->dispatch(new ListPostsQuery())->last(HandledStamp::class)->getResult();
        return $this->json(["posts" => $this->serializer->deserialize($this->serializer->serialize($posts, 'json'), 'array', 'json')], 201);
    }
}