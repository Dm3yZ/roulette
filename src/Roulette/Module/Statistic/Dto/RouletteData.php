<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Dto;
/**
 * Class RouletteData
 * @package Roulette\Module\Statistic\Dto
 */
class RouletteData implements StatisticDataInterface
{
    /**
     * @var RoundData[]
     */
    private array $roundsData;

    /**
     * RouletteData constructor.
     * @param array|RoundData[] $roundsData
     */
    public function __construct($roundsData)
    {
        $this->roundsData = $roundsData;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [] ;
        foreach ($this->roundsData as $data) {
            $array[] = $data->toArray();
        }

        return $array;
    }
}
