<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Service;

use Roulette\Module\Rolling\Entity\Round;
use Roulette\Module\Rolling\Factory\RoundFactory;
use Roulette\Module\Rolling\Repository\RoundRepositoryInterface;

/**
 * Class RoundService
 * @package Roulette\Module\Rolling\Service
 */
class RoundService
{
    private RoundRepositoryInterface $roundRepository;
    private RoundFactory $roundFactory;

    /**
     * RoundService constructor.
     * @param RoundRepositoryInterface $roundRepository
     * @param RoundFactory $roundFactory
     */
    public function __construct(RoundRepositoryInterface $roundRepository, RoundFactory $roundFactory)
    {
        $this->roundRepository = $roundRepository;
        $this->roundFactory = $roundFactory;
    }

    /**
     * @return Round
     */
    public function getCurrentRound(): Round
    {
        $round = $this->roundRepository->findLastRound();
        if (null === $round || $round->isEnd()) {
            $round = $this->roundFactory->create();
        }

        return $round;
    }
}
