<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Entity;

/**
 * Class SelectionProbability
 * @package Roulette\Module\Rolling\Entity
 */
class SelectionProbability
{
    private int $minCellId;
    private int $maxCellId;
    private int $cell;

    /**
     * SelectionProbability constructor.
     * @param int $minCellId
     * @param int $maxCellId
     * @param int $cell
     */
    public function __construct(int $minCellId, int $maxCellId, int $cell)
    {
        $this->minCellId = $minCellId;
        $this->maxCellId = $maxCellId;
        $this->cell = $cell;
    }

    /**
     * @param int $cellId
     * @return bool
     */
    public function isFit(int $cellId): bool
    {
        return $this->minCellId <= $cellId && $this->maxCellId >= $cellId;
    }

    /**
     * @return int
     */
    public function getCell(): int
    {
        return $this->cell;
    }
}
