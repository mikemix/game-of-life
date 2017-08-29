<?php

namespace mikemix\Tests\GameOfLife;

use mikemix\GameOfLife\Game\GliderGunMatrix;
use mikemix\GameOfLife\Game\RandomMatrix;
use mikemix\GameOfLife\MatrixAbstractFactory;
use PHPUnit\Framework\TestCase;

final class MatrixAbstractFactoryTest extends TestCase
{
    /** @var MatrixAbstractFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new MatrixAbstractFactory();
    }

    public function testItCreatesRandomMatrix()
    {
        $this->assertInstanceOf(RandomMatrix::class, $this->factory->create('random'));
    }

    public function testItCreatesGliderGunMatrix()
    {
        $this->assertInstanceOf(GliderGunMatrix::class, $this->factory->create('glider_gun'));
    }
}
