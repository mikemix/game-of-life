<?php

namespace mikemix\GameOfLife\Game;

final class Cell
{
    const DEFAULT_LIVES = 1;

    private $livesLeft;

    private function __construct(int $livesLeft)
    {
        if ($livesLeft < 0 || $livesLeft > self::DEFAULT_LIVES) {
            throw new \InvalidArgumentException(
                sprintf('Life between 0-%d required. %d given', self::DEFAULT_LIVES, $livesLeft)
            );
        }

        $this->livesLeft = $livesLeft;
    }

    public static function alive(): self
    {
        return new self(self::DEFAULT_LIVES);
    }

    public static function dead(): self
    {
        return new self(0);
    }

    public function isAlive(): bool
    {
        return $this->getLivesLeft() > 0;
    }

    public function getLivesLeft(): int
    {
        return $this->livesLeft;
    }

    public function tick(int $aliveNeighbors): self
    {
        if ($this->isAlive()) {
            return new self(in_array($aliveNeighbors, [2, 3], true) ?
                $this->getLivesLeft() :
                $this->getLivesLeft() - 1
            );
        }

        return 3 === $aliveNeighbors ? self::alive() : self::dead();
    }
}
