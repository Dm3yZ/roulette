<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Factory;

use Roulette\Module\Rolling\Entity\Round;

/**
 * Class RoundFactory
 * @package Roulette\Module\Rolling\Factory
 */
class RoundFactory
{
    /**
     * @var int
     */
    private int $cellsCount;

    /**
     * RoundFactory constructor.
     * @param int $cellsCount
     */
    public function __construct(int $cellsCount)
    {
        $this->cellsCount = $cellsCount;
    }

    public function create(): Round
    {
        return new Round($this->cellsCount);
    }
}
