<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Dto;

/**\
 * Class UserStatistic
 * @package Roulette\Module\Statistic\Dto
 */
class UserData implements StatisticDataInterface
{
    private int $userId;
    private int $participationRoundCount;
    private float $averageRolls;

    /**
     * UserStatistic constructor.
     * @param int $userId
     * @param int $participationRoundCount
     * @param float $averageRolls
     */
    public function __construct(int $userId, int $participationRoundCount, float $averageRolls)
    {
        $this->userId = $userId;
        $this->participationRoundCount = $participationRoundCount;
        $this->averageRolls = $averageRolls;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'participationRoundCount' => $this->participationRoundCount,
            'averageRolls' => $this->averageRolls,
        ];
    }
}
