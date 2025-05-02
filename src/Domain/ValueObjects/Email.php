<?php

declare(strict_types=1);

namespace Domain\ValueObjects;

use Webmozart\Assert\Assert;

readonly class Email
{
    private string $email;

    private function __construct(string $email)
    {
        Assert::notEmpty($email, 'Email address cannot be empty');
        Assert::email($email, 'Email address is not valid');

        $this->email = $email;
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function equals(self $other): bool
    {
        return strtolower($this->email) === strtolower($other->email);
    }
}
