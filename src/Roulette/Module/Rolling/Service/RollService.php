<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Service;

use Roulette\Module\Common\DataBase\ObjectManagerInterface;
use Roulette\Module\Rolling\Dto\RollRequest;
use Roulette\Module\Rolling\Dto\RollResult;
use Roulette\Module\Rolling\Factory\DropResultFactory;
use Roulette\Module\Rolling\Factory\RollResultFactory;

/**
 * Class RollService
 * @package App\Roulette\Module\Rolling\Service
 */
class RollService
{
    private RoundService $roundService;
    private DropResultFactory $dropResultFactory;
    private ObjectManagerInterface $objectManager;
    private RollResultFactory $rollResultFactory;
    private CellSelector $cellSelector;

    /**
     * RollService constructor.
     * @param RoundService $roundService
     * @param DropResultFactory $dropResultFactory
     * @param ObjectManagerInterface $entityManager
     * @param RollResultFactory $rollResultFactory
     * @param CellSelector $cellSelector
     */
    public function __construct(
        RoundService $roundService,
        DropResultFactory $dropResultFactory,
        ObjectManagerInterface $entityManager,
        RollResultFactory $rollResultFactory,
        CellSelector $cellSelector
    ) {
        $this->roundService = $roundService;
        $this->dropResultFactory = $dropResultFactory;
        $this->objectManager = $entityManager;
        $this->rollResultFactory = $rollResultFactory;
        $this->cellSelector = $cellSelector;
    }

    /**
     * @param RollRequest $rollRequest
     * @return RollResult
     */
    public function roll(RollRequest $rollRequest): RollResult
    {
        $dropAction = function() use ($rollRequest) {
            $round = $this->roundService->getCurrentRound();
            $cellNumber = null;
            if (! $round->isJackPotTurn()) {
                $cellNumber = $this->cellSelector->select($round->getNotDroppedCells());
            }

            $dropResult = $this->dropResultFactory->create($rollRequest, $round, $cellNumber);
            $this->objectManager->persist($round);

            return $this->rollResultFactory->create($dropResult);
        };

        return $this->objectManager->transactional($dropAction);
    }
}
