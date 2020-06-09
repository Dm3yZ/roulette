<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Statistic\Factory;

use Roulette\Module\Rolling\Repository\RoundRepositoryInterface;
use Roulette\Module\Statistic\Dto\RouletteData;
use Roulette\Module\Statistic\Dto\StatisticDataInterface;

/**
 * Class RouletteStatisticFactory
 * @package Roulette\Module\Statistic\Factory
 */
class RouletteStatisticFactory extends AbstractStatisticFactory
{
    private RoundRepositoryInterface $roundRepository;

    /**
     * RouletteStatisticFactory constructor.
     * @param RoundRepositoryInterface $roundRepository
     */
    public function __construct(RoundRepositoryInterface $roundRepository)
    {
        $this->roundRepository = $roundRepository;
    }

    /**
     * @param array $parameters
     * @return StatisticDataInterface
     */
    protected function getData(array $parameters = []): StatisticDataInterface
    {
        $roundsData = $this->roundRepository->findUsersCountParticipationByRound();

        return new RouletteData($roundsData);
    }
}
