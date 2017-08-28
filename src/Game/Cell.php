<?php

namespace mikemix\GameOfLife\Game;

final class Cell
{
    private $alive;

    private function __construct(bool $isAlive)
    {
        $this->alive = $isAlive;
    }

    public static function alive(): self
    {
        return new self(true);
    }

    public static function dead(): self
    {
        return new self(false);
    }

    public function isAlive(): bool
    {
        return $this->alive;
    }

    public function tick(int $aliveNeighbors): self
    {
        if ($this->isAlive()) {
            return new self(in_array($aliveNeighbors, [2, 3], true));
        }

        return new self(3 === $aliveNeighbors);
    }
}
