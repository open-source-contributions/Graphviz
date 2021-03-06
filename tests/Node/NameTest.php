<?php
declare(strict_types = 1);

namespace Tests\Innmind\Graphviz\Node;

use Innmind\Graphviz\{
    Node\Name,
    Exception\DomainException
};
use PHPUnit\Framework\TestCase;
use Eris\{
    Generator,
    TestTrait
};

class NameTest extends TestCase
{
    use TestTrait;

    public function testInterface()
    {
        $this
            ->minimumEvaluationRatio(0.4)
            ->forAll(Generator\string())
            ->when(static function(string $string): bool {
                return strlen($string) > 0 && strpos($string, '->') === false && strpos($string, '-') === false && strpos($string, '.') === false;
            })
            ->then(function(string $string): void {
                $this->assertSame($string, (new Name($string))->toString());
            });
    }

    public function testThrowWhenEmpty()
    {
        $this->expectException(DomainException::class);

        new Name('');
    }

    public function testThrowWhenContainingAnArrow()
    {
        $this->expectException(DomainException::class);

        new Name('->');
    }

    public function testThrowWhenContainingAnDash()
    {
        $this->expectException(DomainException::class);

        new Name('-');
    }

    public function testThrowWhenContainingADot()
    {
        $this->expectException(DomainException::class);

        new Name('.');
    }

    public function testThrowWhenContainingANullCharacter()
    {
        $this->expectException(DomainException::class);

        new Name("\x00");
    }
}
