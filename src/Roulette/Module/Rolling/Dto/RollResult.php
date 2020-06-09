<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Dto;

/**
 * Class RollResult
 * @package Roulette\Module\Rolling\Dto
 */
class RollResult
{
    private int $roundId;
    private bool $isJackPot;
    private ?int $cellNumber;

    /**
     * RollResult constructor.
     * @param int $roundId
     * @param bool $isJackPot
     * @param int|null $cellNumber
     */
    public function __construct(int $roundId, bool $isJackPot, ?int $cellNumber)
    {
        $this->roundId = $roundId;
        $this->isJackPot = $isJackPot;
        $this->cellNumber = $cellNumber;
    }
}
