<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Dto;

/**
 * Class UsersStatistic
 * @package Roulette\Module\Statistic\Dto
 */
class UsersStatistic implements StatisticDataInterface
{
    /**
     * @var UserData[]
     */
    private array $userData;

    /**
     * UsersStatistic constructor.
     * @param array|UserData[] $userData
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [] ;
        foreach ($this->userData as $data) {
            $array[] = $data->toArray();
        }

        return $array;
    }
}
