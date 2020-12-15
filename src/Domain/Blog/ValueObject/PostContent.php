<?php
declare(strict_types=1);

namespace App\Domain\Blog\ValueObject;


use Assert\Assertion;

final class PostContent
{
    private string $content;

    public static function fromString(string $aPostContent): PostContent
    {
        Assertion::notEmpty($aPostContent);
        Assertion::minLength($aPostContent,10);

        return new static($aPostContent);
    }

    private function __construct(string $content)
    {
        $this->content = $content;
    }

    public function content(): string
    {
        return $this->content;
    }
}