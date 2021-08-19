<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SortieEtatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // todo refaire la fixture sorties pour correspondre aux modifs des entités

        // $product = new Product();

        // Les Etats
        /*$etat = new Etat();
        $etat->setLibelle('Créée');
        $manager->persist($etat);
        $etat = new Etat();
        $etat->setLibelle('Ouverte');
        $manager->persist($etat);
        $etat = new Etat();
        $etat->setLibelle('Clôturée');
        $manager->persist($etat);
        $etat = new Etat();
        $etat->setLibelle('En Cours');
        $manager->persist($etat);
        $etat = new Etat();
        $etat->setLibelle('Passée');
        $manager->persist($etat);
        $etat = new Etat();
        $etat->setLibelle('Annulée');
        $manager->persist($etat);

        // Les Sorties

        $sortie = new Sortie();
        $sortie->setNom('Philo');
        $sortie->setDateHeureDebut(new \DateTime("2018-07-19 23:45:00"));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2018-07-19'));
        $sortie->setNbInscriptionsMax(8);
        $sortie->setInfosSortie('Infos de la sortie 1');
        $sortie->setEtat($etat);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Origamie');
        $sortie->setDateHeureDebut(new \DateTime('2018-07-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2018-07-19'));
        $sortie->setNbInscriptionsMax(5);
        $sortie->setInfosSortie('Infos de la sortie 2');
        $sortie->setEtat($etat);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Perles');
        $sortie->setDateHeureDebut(new \DateTime('2018-07-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2018-07-19'));
        $sortie->setNbInscriptionsMax(12);
        $sortie->setInfosSortie('Infos de la sortie 3');
        $sortie->setEtat($etat);
        $manager->persist($sortie);

        $manager->flush();*/
    }
}
