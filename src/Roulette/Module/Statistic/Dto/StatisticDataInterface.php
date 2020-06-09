<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 9:31 PM
 */

namespace Roulette\Module\Statistic\Dto;

/**
 * Interface StatisticDataInterface
 * @package Roulette\Module\Statistic\Dto
 */
interface StatisticDataInterface
{
    public function toArray(): array;
}
