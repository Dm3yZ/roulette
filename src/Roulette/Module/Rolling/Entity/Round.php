<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class Round
 * @package Roulette\Module\Rolling\Entity
 */
class Round
{
    private int $id;
    private int $cellsCount;

    /**
     * @var Collection|DropResult[]
     */
    private Collection $dropResults;

    public function __construct(int $cellCount)
    {
        $this->cellsCount = $cellCount;
        $this->dropResults = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isEnd(): bool
    {
        return count($this->dropResults) === $this->cellsCount + 1;
    }

    /**
     * @return bool
     */
    public function isJackPotTurn(): bool
    {
        return count($this->dropResults) === $this->cellsCount;
    }

    /**
     * @param DropResult $dropResult
     */
    public function addDropResult(DropResult $dropResult): void
    {
        $this->dropResults->add($dropResult);
    }

    /**
     * @return array
     */
    public function getNotDroppedCells(): array
    {
        $droppedCells = [];
        foreach ($this->dropResults as $dropResult) {
            if (! $dropResult->isJackPot()) {
                $droppedCells[] = $dropResult->getCellNumber();
            }
        }
        $possibleCellsNumbers = range(1, $this->cellsCount);

        return array_diff($possibleCellsNumbers, $droppedCells);
    }
}
