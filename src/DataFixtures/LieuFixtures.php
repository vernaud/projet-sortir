<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LieuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Villes
        /*$ville1 = new Ville();
        $ville1->setNom('Nantes');
        $ville1->setCodePostal('44000');
        $manager->persist($ville1);

        $ville2 = new Ville();
        $ville2->setNom('La Roche sur Yon');
        $ville2->setCodePostal('85000');
        $manager->persist($ville2);

        $ville3 = new Ville();
        $ville3->setNom('Saint Herblain');
        $ville3->setCodePostal('44800');
        $manager->persist($ville3);

        $manager->flush();*/


        // Lieux
        /*$lieu = new Lieu();
        $lieu->setNom('Berlin89 - Saint Herblain');
        $lieu->setRue('9 Rue des Piliers de la Chauvinière');
        $lieu->setLatitude(47.231379195641715);
        $lieu->setLongitude(-1.6381733158538803);
        $lieu->setVille(); /*<= problème comment récupérer l'ID?
        $manager->persist($lieu);

        $lieu = new Lieu();
        $lieu->setNom('Lieu Unique');
        $lieu->setRue('2 Rue de la Biscuiterie');
        $lieu->setLatitude(47.21572132826369);
        $lieu->setLongitude(-1.5456496590888569);
        $lieu->setVille(); /*<= problème comment récupérer l'ID?
        $manager->persist($lieu);

        $manager->flush();*/
    }
}
