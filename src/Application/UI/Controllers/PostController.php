<?php


namespace App\Application\UI\Controllers;


use App\Application\Command\CreatePostCommand;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostId;
use App\Domain\Blog\ValueObject\PostTitle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {

        $this->bus = $bus;
    }
    /**
     * @Route(path="/", methods={"POST"})
     */
    public function __invoke(Request $request)
    {
        $this->bus->dispatch(new CreatePostCommand(
            PostId::fromString(null),
            PostTitle::fromString($request->get('title')),
            PostContent::fromString($request->get('content'))
        ));
        return $this->json(["status" => "success"], 201);
    }
}