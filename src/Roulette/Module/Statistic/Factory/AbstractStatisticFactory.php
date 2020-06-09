<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Factory;

use Roulette\Module\Statistic\Dto\Statistic;
use Roulette\Module\Statistic\Dto\StatisticDataInterface;

/**
 * Class StatisticFactory
 * @package Roulette\Module\Statistic\Factory
 */
abstract class AbstractStatisticFactory
{
    /**
     * @param array $parameters
     * @return Statistic
     */
    public function create(array $parameters): Statistic
    {
        $statistic = new Statistic();
        $statistic->data = $this->getData($parameters)->toArray();

        return $statistic;
    }

    /**
     * @param array $parameters
     * @return StatisticDataInterface
     */
    abstract protected function getData(array $parameters = []): StatisticDataInterface;
}
