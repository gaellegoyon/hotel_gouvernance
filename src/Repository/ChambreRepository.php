<?php

namespace App\Repository;

use App\Entity\Chambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chambre>
 *
 * @method Chambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chambre[]    findAll()
 * @method Chambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChambreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chambre::class);
    }

public function rechercherChambres($lieu, $libelle, $dateArrivee, $dateDepart)
{
    $queryBuilder = $this->createQueryBuilder('c')
    ->select('c')
    ->addSelect('cat')
    ->join('c.hotel', 'h')
    ->join('c.categorie', 'cat')
    ->leftJoin('c.reservations', 'res')
    ->where('h.lieu = :lieu')
    ->andWhere('cat.libelle = :libelle')
    ->andWhere('(
        (res.date_debut NOT BETWEEN :dateArrivee AND :dateDepart)
        OR (res.date_fin NOT BETWEEN :dateArrivee AND :dateDepart)
        OR (:dateArrivee NOT BETWEEN res.date_debut AND res.date_fin)
        OR (:dateDepart NOT BETWEEN res.date_debut AND res.date_fin)
        )')

        ->setParameter('lieu', $lieu)
        ->setParameter('libelle', $libelle)
        ->setParameter('dateArrivee', $dateArrivee)
        ->setParameter('dateDepart', $dateDepart);


    // Exécutez la requête et retournez les résultats
    return $queryBuilder->getQuery()->getResult();
}

//    /**
//     * @return Chambre[] Returns an array of Chambre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chambre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
