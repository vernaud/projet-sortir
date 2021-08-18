<?php

namespace App\DataFixtures;

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

        $manager->persist($participant);

        $manager->flush();
    }
}
