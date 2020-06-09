<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace App\Tests\Unit\Roulette\Module\Rolling\Service;

use PHPUnit\Framework\TestCase;
use Roulette\Module\Rolling\Service\CellSelector;

/**
 * Class NumberSelectorTest
 * @package App\Tests\Roulette\Module\Rolling\Service
 */
class NumberSelectorTest extends TestCase
{
    private CellSelector $numberSelector;

    protected function setUp(): void
    {
        $this->numberSelector = new CellSelector();
    }

    public function testSelect(): void
    {
        $allowedNumbers = range(1, 10);
        $number = $this->numberSelector->select($allowedNumbers);

        $this->assertContains($number, $allowedNumbers);
    }

    public function testSelectOneNumber(): void
    {
        $number = $this->numberSelector->select([1]);

        $this->assertEquals(1, $number);
    }

    public function testSelectEmptyNumbers(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->numberSelector->select([]);
    }

    public function testSelectZeroNumberSum(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->numberSelector->select([0, 0, 0]);
    }
}
