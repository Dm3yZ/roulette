<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Factory;

use Roulette\Module\Rolling\Dto\RollRequest;
use Roulette\Module\Rolling\Entity\DropResult;
use Roulette\Module\Rolling\Entity\Round;

/**
 * Class DropResultFactory
 * @package Roulette\Module\Rolling\Factory
 */
class DropResultFactory
{
    /**
     * @param RollRequest $rollRequest
     * @param Round $round
     * @param int|null $cellNumber
     * @return DropResult
     * @throws \Exception
     */
    public function create(RollRequest $rollRequest, Round $round, ?int $cellNumber): DropResult
    {
        $dropResult = (new DropResult())
            ->setUserId($rollRequest->getUserId())
            ->setRound($round)
            ->setDropDate(new \DateTime())
            ->setCellNumber($cellNumber);

        $round->addDropResult($dropResult);

        return $dropResult;
    }
}
