<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $campus= new Campus();
        $campus->setNom('Nantes');
        $manager->persist($campus);

        $participant= new Participant();
        $participant->setNom('Ana');
        $participant->setPrenom('Casanova');
        $participant->setTelephone('1234567890');
        $participant->setMail('rana@gmail.com');
        $participant->setMotPasse('larana');
        $participant->setAdministrateur(true);
        $participant->setActif(true);
        $participant->setPseudo('Ranita');
        $participant->setCampus($campus);
        $manager->persist($participant);

        $manager->flush();
    }
}
