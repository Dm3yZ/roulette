<?php

namespace Roulette\Module\Rolling\Repository;

use Roulette\Module\Rolling\Entity\Round;
use Roulette\Module\Statistic\Dto\RoundData;
use Roulette\Module\Statistic\Dto\UserData;

/**
 * Interface RoundRepositoryInterface
 * @package Roulette\Module\Rolling\Repository
 */
interface RoundRepositoryInterface
{
    /**
     * @return Round|null
     */
    public function findLastRound(): ?Round;

    /**
     * @return RoundData[]
     */
    public function findUsersCountParticipationByRound(): array;

    /**
     * @return UserData[]
     */
    public function findUsersParticipationData(): array;
}
