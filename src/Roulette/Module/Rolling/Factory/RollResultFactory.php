<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Factory;

use Roulette\Module\Rolling\Dto\RollResult;
use Roulette\Module\Rolling\Entity\DropResult;

/**
 * Class RollResultFactory
 * @package Roulette\Module\Rolling\Factory
 */
class RollResultFactory
{
    /**
     * @param DropResult $dropResult
     * @return RollResult
     */
    public function create(DropResult $dropResult): RollResult
    {
        return new RollResult(
            $dropResult->getRound()->getId(),
            $dropResult->isJackPot(),
            $dropResult->getCellNumber(),
        );
    }
}
