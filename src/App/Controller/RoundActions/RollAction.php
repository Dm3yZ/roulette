<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/7/20
 * Time: 7:45 PM
 */
declare(strict_types=1);

namespace App\Controller\RoundActions;

use Roulette\Module\Rolling\Dto\RollRequest;
use Roulette\Module\Rolling\Dto\RollResult;
use Roulette\Module\Rolling\Service\RollService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RollAction
 * @package App\Controller\RouletteActions
 */
class RollAction extends AbstractController
{
    private RollService $rollService;

    /**
     * RollAction constructor.
     * @param RollService $rollService
     */
    public function __construct(RollService $rollService)
    {
        $this->rollService = $rollService;
    }

    /**
     * @param RollRequest $rollRequest
     * @return RollResult
     */
    public function __invoke(RollRequest $rollRequest)
    {
        return $this->rollService->roll($rollRequest);
    }
}
