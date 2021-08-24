<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function defaultFind()
    {
        // test avec bouchon
        // à remplacer par valeur du formulaire en param de function
        $filtres = [
            'campus'=>'',
            'search'=>'',
            'dateUn'=>'',
            'dateDeux'=>'',
            'sortieOrganisateur'=>'',
            'sortieInscrit'=>'',
            'sortiePasInscrit'=>'',
            'sortiePassees'=>''
        ];
        // fin bouchon à supprimer



        $queryBuilder = $this->createQueryBuilder('s');


        if (!empty($filtres['campus']) ) {
            $queryBuilder
                ->andWhere('s.campus = :c')
                ->setParameter('c', $filtres['campus']);
        }



        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /*public function findAllSorties() {

        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder ->addOrderBy('s.dateHeureDebut', 'ASC');
        $query = $queryBuilder->getQuery();

        $results = $query->getResult();
        return $results;

    }*/

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
