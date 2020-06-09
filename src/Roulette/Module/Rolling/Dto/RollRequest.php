<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Dto;

/**
 * Class RollRequest
 * @package Roulette\Module\Rolling\Dto
 */
class RollRequest
{
    /**
     * @var int
     */
    private int $userId = 0;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
