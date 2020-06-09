<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Service;

use Roulette\Module\Statistic\Dto\Statistic;
use Roulette\Module\Statistic\Factory\AbstractStatisticFactory;

/**
 * Class StatisticService
 * @package Roulette\Module\Statistic\Service
 */
class StatisticService
{
    private AbstractStatisticFactory $statisticFactory;

    /**
     * StatisticService constructor.
     * @param AbstractStatisticFactory $statisticFactory
     */
    public function __construct(AbstractStatisticFactory $statisticFactory)
    {
        $this->statisticFactory = $statisticFactory;
    }

    /**
     * @param array $parameters
     * @return Statistic
     */
    public function get(...$parameters): Statistic
    {
        return $this->statisticFactory->create($parameters);
    }
}
