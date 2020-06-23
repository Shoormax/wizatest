<?php

namespace Tests\AppBundle\Calculator;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Model\Change;
use AppBundle\Calculator\Mk2Calculator;
use PHPUnit\Framework\TestCase;

class Mk2CalculatorTest extends TestCase
{
    /**
     * @var CalculatorInterface
     */
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Mk2Calculator();
    }

    public function testGetSupportedModel(): void
    {
        $this->assertEquals('mk2', $this->calculator->getSupportedModel());
    }

    public function testGetChangeEasy(): void
    {
        $change = $this->calculator->getChange(2);
        $this->assertInstanceOf(Change::class, $change);
        $this->assertEquals(1, $change->coin2);
    }

    public function testGetChangeImpossible(): void
    {
        $change = $this->calculator->getChange(1);
        $this->assertNull($change);
    }

    public function testGetChangeHard(): void
    {
        $change = $this->calculator->getChange(129);
        $this->assertEquals(0, $change->coin1);
        $this->assertEquals(2, $change->coin2);
        $this->assertEquals(1, $change->bill5);
        $this->assertEquals(12, $change->bill10);
    }
}