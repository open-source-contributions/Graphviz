<?php
declare(strict_types = 1);

namespace Innmind\Graphviz\Graph;

final class Rankdir
{
    private static ?self $lr;
    private static ?self $tb;
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function topToBottom(): self
    {
        return self::$tb ?? self::$tb = new self('TB');
    }

    public static function leftToRight(): self
    {
        return self::$lr ?? self::$lr = new self('LR');
    }

    public function toString(): string
    {
        return $this->value;
    }
}
