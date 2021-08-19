<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Les Campus
        $campus= new Campus();
        $campus->setNom('Saint-Herblain');
        $manager->persist($campus);
        $campus= new Campus();
        $campus->setNom('Chartres de Bretagne');
        $manager->persist($campus);
        $campus= new Campus();
        $campus->setNom('La Roche sur Yon');
        $manager->persist($campus);

        // Les Etats
        $etat = new Etat();
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

        // 1 Participant
        $participant = new Participant();
        $participant->setNom('DELORD');
        $participant->setPrenom('Matthieu');
        $participant->setPseudo('superDev44');
        $participant->setTelephone('0654986532');
        $participant->setEmail('superdev@eni.fr');
        $participant->setPassword($this->passwordHasher->hashPassword(
            $participant,
            'pass'
        ));
        $participant->setRoles(['ROLE_USER']);
        $participant->setActif(true);
        $participant->setCampus($campus);
        $manager->persist($participant);

        // insertion
        $manager->flush();
    }
}
