<?php

declare(strict_types=1);
namespace App\Domain\Blog\ValueObject;


use Ramsey\Uuid\Uuid;

final class PostId
{
    private $id;

    public static function fromString(string $uuid = null): PostId
    {
        if($uuid != null) {
            if(Uuid::isValid($uuid)){
                return new static($uuid);
            }
        }
        return new static(Uuid::uuid4()->toString());
    }

    private function __construct(string $uuid)
    {
        $this->id = $uuid;
    }

    public function id(): string
    {
        return $this->id;
    }
}