<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Entity;

/**
 * Class DropResult
 *
 * @package Roulette\Module\Rolling\Entity
 */
class DropResult
{
    private int $id;
    private int $userId;
    private ?int $cellNumber = null;
    private \DateTime $dropDate;
    private Round $round;

    /**
     * @return int|null
     */
    public function getCellNumber(): ?int
    {
        return $this->cellNumber;
    }

    public function isJackPot(): bool
    {
        return null === $this->cellNumber;
    }

    /**
     * @param int $userId
     * @return DropResult
     */
    public function setUserId(int $userId): DropResult
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param null|int $cellNumber
     * @return DropResult
     */
    public function setCellNumber(?int $cellNumber): DropResult
    {
        $this->cellNumber = $cellNumber;
        return $this;
    }

    /**
     * @param \DateTime $dropDate
     * @return DropResult
     */
    public function setDropDate(\DateTime $dropDate): DropResult
    {
        $this->dropDate = $dropDate;
        return $this;
    }

    /**
     * @param Round $round
     * @return DropResult
     */
    public function setRound(Round $round): DropResult
    {
        $this->round = $round;
        return $this;
    }

    /**
     * @return Round
     */
    public function getRound(): Round
    {
        return $this->round;
    }
}
