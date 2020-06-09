<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Service;

use Roulette\Module\Rolling\Entity\SelectionProbability;

/**
 * Class NumberGenerator
 * @package Roulette\Module\Rolling\Service
 */
class CellSelector
{
    /**
     * @param int[] $possibleCells
     * @return int
     * @throws \Exception
     */
    public function select(array $possibleCells): int
    {
        if (empty($possibleCells)) {
            throw new \InvalidArgumentException('Possible cells can not be empty');
        }

        $maxCellsId = array_sum($possibleCells);
        if ($maxCellsId === 0) {
            throw new \InvalidArgumentException('Sum of allowed cells must be greater than 0');
        }

        $cellId = random_int(1, $maxCellsId);
        $selectionProbabilities = $this->createSelectionProbabilities($possibleCells);
        foreach ($selectionProbabilities as $selectionProbability) {
            if ($selectionProbability->isFit($cellId)) {
                return $selectionProbability->getCell();
            }
        }

        throw new \RuntimeException('Filed to select cell');
    }

    /**
     * @param int[] $possibleCells
     * @return \Generator|SelectionProbability[]
     */
    private function createSelectionProbabilities(array $possibleCells): \Generator
    {
        $cellId = 0;
        shuffle($possibleCells);
        foreach ($possibleCells as $cell) {
            yield new SelectionProbability($cellId + 1, $cellId + $cell, $cell);
            $cellId+= $cell;
        }
    }
}
