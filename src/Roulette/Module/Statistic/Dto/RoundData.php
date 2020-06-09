<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Dto;

/**
 * Class RoundData
 * @package Roulette\Module\Statistic\Dto
 */
class RoundData implements StatisticDataInterface
{
    private int $roundId;
    private int $usersCount;

    /**
     * RoundData constructor.
     * @param int $roundId
     * @param int $usersCount
     */
    public function __construct(int $roundId, int $usersCount)
    {
        $this->roundId = $roundId;
        $this->usersCount = $usersCount;
    }

    public function toArray(): array
    {
        return [
            'roundId' => $this->roundId,
            'usersCount' => $this->usersCount,
        ];
    }
}
