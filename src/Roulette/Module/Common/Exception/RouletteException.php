<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 3:23 AM
 */
declare(strict_types=1);

namespace Roulette\Module\Common\Exception;

/**
 * Class RouletteException
 * @package Roulette\Module\Common\Exception
 */
abstract class RouletteException extends \Exception
{
    abstract public function getStatusCode(): int;
    abstract public function getErrorCode(): int;
}
