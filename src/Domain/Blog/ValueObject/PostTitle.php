<?php
declare(strict_types=1);

namespace App\Domain\Blog\ValueObject;


use Assert\Assertion;

final class PostTitle
{
    private string $title;

    public static function fromString(string $aPostTitle): PostTitle
    {
        Assertion::notEmpty($aPostTitle);
        Assertion::minLength($aPostTitle,10);

        return new static($aPostTitle);
    }

    private function __construct(string $title)
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
}