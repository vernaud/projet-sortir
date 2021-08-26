<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Entity\Ville;
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
        /* ************ CAMPUS ************ */
        $campus= new Campus();
        $campus->setNom('Saint-Herblain');
        $manager->persist($campus);
        $campus= new Campus();
        $campus->setNom('Chartres de Bretagne');
        $manager->persist($campus);
        $campus= new Campus();
        $campus->setNom('La Roche sur Yon');
        $manager->persist($campus);

        /* ************ ETAT ************ */
        $etat1 = new Etat();
        $etat1->setLibelle('Créée');
        $manager->persist($etat1);
        $etat2 = new Etat();
        $etat2->setLibelle('Ouverte');
        $manager->persist($etat2);
        $etat3 = new Etat();
        $etat3->setLibelle('Clôturée');
        $manager->persist($etat3);
        $etat4 = new Etat();
        $etat4->setLibelle('En Cours');
        $manager->persist($etat4);
        $etat5 = new Etat();
        $etat5->setLibelle('Passée');
        $manager->persist($etat5);
        $etat6 = new Etat();
        $etat6->setLibelle('Annulée');
        $manager->persist($etat6);

        /* ************ PARTICIPANT ************ */
        $participant1 = new Participant();
        $participant1->setNom('DELORD');
        $participant1->setPrenom('Matthieu');
        $participant1->setPseudo('superDev44');
        $participant1->setTelephone('0654986532');
        $participant1->setEmail('superdev@eni.fr');
        $participant1->setPassword($this->passwordHasher->hashPassword(
            $participant1,
            'pass'));
        $participant1->setRoles(['admin'=>'ROLE_ADMIN']);
        $participant1->setActif(true);
        $participant1->setCampus($campus);
        $manager->persist($participant1);


        $participant2 = new Participant();
        $participant2->setNom('CALIENDO');
        $participant2->setPrenom('Julien');
        $participant2->setPseudo('tesla44');
        $participant2->setTelephone('0642987832');
        $participant2->setEmail('tesla@eni.fr');
        $participant2->setPassword($this->passwordHasher->hashPassword(
            $participant2,
            'pass'));
        $participant2->setActif(true);
        $participant2->setCampus($campus);
        $manager->persist($participant2);

        /* ************ VILLE ************ */
        $ville1 = new Ville();
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


        /* ************ LIEU ************ */
        $lieu = new Lieu();
        $lieu->setNom('Berlin89 - Saint Herblain');
        $lieu->setRue('9 Rue des Piliers de la Chauvinière');
        $lieu->setLatitude(47.231379195641715);
        $lieu->setLongitude(-1.6381733158538803);
        $lieu->setVille($ville3);
        $manager->persist($lieu);

        $lieu = new Lieu();
        $lieu->setNom('Lieu Unique');
        $lieu->setRue('2 Rue de la Biscuiterie');
        $lieu->setLatitude(47.21572132826369);
        $lieu->setLongitude(-1.5456496590888569);
        $lieu->setVille($ville1);
        $manager->persist($lieu);

        /* ************ SORTIE ************ */
        $sortie = new Sortie();
        $sortie->setNom('Philo');
        $sortie->setDateHeureDebut(new \DateTime("2021-09-19 23:45:00"));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-15'));
        $sortie->setNbInscriptionsMax(8);
        $sortie->setInfosSortie('Infos de la sortie 1');
        $sortie->setEtat($etat1);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant1);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Origamie');
        $sortie->setDateHeureDebut(new \DateTime('2021-09-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-15'));
        $sortie->setNbInscriptionsMax(5);
        $sortie->setInfosSortie('Infos de la sortie 2');
        $sortie->setEtat($etat2);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant2);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Perles');
        $sortie->setDateHeureDebut(new \DateTime('2021-09-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-15'));
        $sortie->setNbInscriptionsMax(12);
        $sortie->setInfosSortie('Infos de la sortie 3');
        $sortie->setEtat($etat3);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant2);
        $sortie->addParticipant($participant1);
        $sortie->addParticipant($participant2);
        $manager->persist($sortie);

        /* ************ SORTIE ************ */
        $sortie = new Sortie();
        $sortie->setNom('Philo');
        $sortie->setDateHeureDebut(new \DateTime("2021-09-19 23:45:00"));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-15'));
        $sortie->setNbInscriptionsMax(8);
        $sortie->setInfosSortie('Infos de la sortie 4');
        $sortie->setEtat($etat4);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant1);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Origamie');
        $sortie->setDateHeureDebut(new \DateTime('2021-08-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-08-20'));
        $sortie->setNbInscriptionsMax(8);
        $sortie->setInfosSortie('Infos de la sortie 5');
        $sortie->setEtat($etat5);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant2);
        $manager->persist($sortie);

        $sortie = new Sortie();
        $sortie->setNom('Perles');
        $sortie->setDateHeureDebut(new \DateTime('2021-09-21 20:00:00'));
        $sortie->setDuree(90);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-15'));
        $sortie->setNbInscriptionsMax(12);
        $sortie->setInfosSortie('Infos de la sortie 6');
        $sortie->setEtat($etat6);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu);
        $sortie->setOrganisateur($participant2);
        $sortie->addParticipant($participant1);
        $sortie->addParticipant($participant2);
        $manager->persist($sortie);


        // insertion
        $manager->flush();
    }
}
