<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 * Time: 2:08 PM
 */
declare(strict_types=1);

namespace Roulette\Module\Common\DataBase;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class EntityManagerAdapter
 * @package Roulette\Module\Common\DataBase
 */
class EntityManagerAdapter implements ObjectManagerInterface
{
    private EntityManagerInterface $em;

    /**
     * EntityManagerAdapter constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $object
     */
    public function persist($object): void
    {
        $this->em->persist($object);
    }

    /**
     * @param $func
     * @return mixed
     */
    public function transactional($func)
    {
        return $this->em->transactional($func);
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->em->flush();
    }
}
