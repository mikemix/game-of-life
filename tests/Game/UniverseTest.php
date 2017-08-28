<?php

namespace mikemix\Tests\GameOfLife\Game;

use mikemix\GameOfLife\Game\AbstractMatrix2D;
use mikemix\GameOfLife\Game\Cell;
use mikemix\GameOfLife\Game\Universe;
use PHPUnit\Framework\TestCase;

final class UniverseTest extends TestCase
{
    private function createMatrix(array $matrix): AbstractMatrix2D
    {
        return new class ($matrix) extends AbstractMatrix2D {
        };
    }

    public function testGetMatrix()
    {
        $universe = new Universe($this->createMatrix([
            [Cell::dead(), Cell::dead()],
            [Cell::dead(), Cell::alive()],
        ]));

        $this->assertEquals([
            [0, 0],
            [0, Cell::DEFAULT_LIVES],
        ], $universe->getContext(5)->getCells());
    }

    public function testTickCreatesIsImmutable()
    {
        $universe = new Universe($this->createMatrix([]));

        $tick = $universe->tick();

        $this->assertNotSame($tick, $universe);
    }

    public function testTickBumpsGenerationCounter()
    {
        $universe = new Universe($this->createMatrix([]));
        $universe = $universe->tick();
        $universe = $universe->tick();

        $this->assertEquals(3, $universe->getContext(5)->getIteration());
    }

    public function testGetContextReturnsImmutableContext()
    {
        $universe = new Universe($this->createMatrix([]));

        $this->assertNotSame($universe->getContext(5), $universe->getContext(5));
    }
}
