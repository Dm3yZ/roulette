<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/8/20
 * Time: 5:14 AM
 */
declare(strict_types=1);

namespace Roulette\Module\Common\DataBase;

/**
 * Interface ObjectManagerInterface
 * @package Roulette\Module\Common\DataBase
 */
interface ObjectManagerInterface
{
    public function persist($object);
    public function transactional($func);
    public function flush();
}
