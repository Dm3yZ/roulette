<?php
/**
 * @author Zyankin Dmitry zyankin.dima@gmail.com
 * Date: 6/9/20
 */
declare(strict_types=1);

namespace Roulette\Module\Rolling\Repository\DoctrineOrm;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Roulette\Module\Rolling\Entity\Round;
use Roulette\Module\Rolling\Repository\RoundRepositoryInterface;
use Roulette\Module\Statistic\Dto\RoundData;
use Roulette\Module\Statistic\Dto\UserData;

/**
 * @method Round|null find($id, $lockMode = null, $lockVersion = null)
 * @method Round|null findOneBy(array $criteria, array $orderBy = null)
 * @method Round[]    findAll()
 * @method Round[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundRepository extends ServiceEntityRepository implements RoundRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Round::class);
    }

    /**
     * @return Round|null
     * @throws NonUniqueResultException
     */
    public function findLastRound(): ?Round
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.dropResults', 'dr')
            ->addOrderBy('dr.dropDate', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function findUsersCountParticipationByRound(): array
    {
        $arrayResult = $this->createQueryBuilder('r')
            ->select(['r.id as id', 'COUNT(DISTINCT dr.userId) as userCount'])
            ->leftJoin('r.dropResults', 'dr')
            ->groupBy('r.id')
            ->getQuery()
            ->getArrayResult();

        $roundsData = [];
        foreach ($arrayResult as $item) {
            if (isset($item['id'], $item['userCount'])) {
                $roundsData[] = new RoundData($item['id'], $item['userCount']);
            }
        }

        return $roundsData;
    }

    /**
     * @return array
     */
    public function findUsersParticipationData(): array
    {
        $arrayResult = $this->createQueryBuilder('r')
            ->select(['dr.userId as userId, count(DISTINCT r) as roundCount, count(dr) as rollCount'])
            ->leftJoin('r.dropResults', 'dr')
            ->groupBy('dr.userId')
            ->addOrderBy('roundCount', 'DESC')
            ->getQuery()
            ->getArrayResult();

        $roundsData = [];
        foreach ($arrayResult as $item) {
            if (isset($item['userId'], $item['roundCount'], $item['rollCount'])) {
                $avgRolls = \round($item['rollCount'] / $item['roundCount'], 2);
                $roundsData[] = new UserData($item['userId'], $item['roundCount'], $avgRolls);
            }
        }

        return $roundsData;
    }
}
