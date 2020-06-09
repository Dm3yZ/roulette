<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 7:56 PM
 */
declare(strict_types=1);

namespace App\Controller\StatisticActions;

use Roulette\Module\Statistic\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RouletteStatisticAction
 * @package App\Controller\StatisticActions
 */
class CommonStatisticAction extends AbstractController
{
    private StatisticService $statisticService;

    /**
     * RouletteStatisticAction constructor.
     * @param StatisticService $statisticService
     */
    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function __invoke()
    {
        return $this->statisticService->get();
    }
}
