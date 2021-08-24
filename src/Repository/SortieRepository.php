<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isTrue;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function defaultFind($filtres, $participant)
    {
        /*$filtres = [
            'campus'=>'object Campus',
            'search'=>'string',
            'dateUn'=> dateTime'2021-08-19',
            'dateDeux'=>dateTime'2021-08-20',
            'sortieOrganisateur'=>'true',
            'sortieInscrit'=>'true',
            'sortiePasInscrit'=>'true',
            'sortiePassees'=>'true'
        ];*/

        //debug
        dump($filtres);



        $queryBuilder = $this->createQueryBuilder('s');

        if (!empty($filtres['campus']) ) {
            $queryBuilder
                ->andWhere('s.campus = :c')
                ->setParameter('c', $filtres['campus']);
        }

        if (!empty($filtres['search']) ) {
            $queryBuilder
                ->andWhere('s.nom LIKE :p')
                ->setParameter('p', '%'.$filtres['search'].'%');
        }

        /*if (!empty($filtres['dateUn']) && !empty($filtres['dateDeux'] &&
                $filtres['dateUn'] <= $filtres['dateDeux']) ) {

        }*/

        if (!empty($filtres['sortieOrganisateur']) ) {
            $queryBuilder
                ->andWhere('s.organisateur = :o')
                ->setParameter('o', $participant);
            dump("isTrue");
        }

        if (!empty($filtres['sortieInscrit']) ) {

        }

        if (!empty($filtres['sortiePasInscrit']) ) {

        }

        if (!empty($filtres['sortiePassees']) ) {
            // affiche QUE les sorties > now
        }

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
     * @param int $id
     * @return Sortie
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getSortieById(int $id): Sortie {

        $req = $this->createQueryBuilder('sortie')
            ->where('sortie.id = :id')->setParameter('id', $id);

        return $req->getQuery()->getSingleResult();
    }



}
