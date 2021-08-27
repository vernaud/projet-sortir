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

        $campus2= new Campus();
        $campus2->setNom('Chartres de Bretagne');
        $manager->persist($campus2);

        $campus3= new Campus();
        $campus3->setNom('La Roche sur Yon');
        $manager->persist($campus3);

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
        $participant1->setNom('SORIN');
        $participant1->setPrenom('Antoine');
        $participant1->setPseudo('AsPointCom');
        $participant1->setTelephone('0109024451');
        $participant1->setEmail('contact@antoine-sorin.com');
        $participant1->setPassword($this->passwordHasher->hashPassword(
            $participant1,
            'pass'));
        $participant1->setRoles(['admin'=>'ROLE_ADMIN']);
        $participant1->setActif(true);
        $participant1->setCampus($campus);
        $manager->persist($participant1);


        $participant2 = new Participant();
        $participant2->setNom('CHABAT');
        $participant2->setPrenom('Alain');
        $participant2->setPseudo('Burgy');
        $participant2->setTelephone('0109024450');
        $participant2->setEmail('burgy@burgerquiz.fr');
        $participant2->setPassword($this->passwordHasher->hashPassword(
            $participant2,
            'pass'));
//        $participant2->setRoles(['admin'=>'ROLE_ADMIN']);
        $participant2->setActif(true);
        $participant2->setCampus($campus);
        $manager->persist($participant2);

        $participant3 = new Participant();
        $participant3->setNom('CAMUS');
        $participant3->setPrenom('Jean-Claude');
        $participant3->setPseudo('JCCProd');
        $participant3->setTelephone('0109024453');
        $participant3->setEmail('jc@camus-prod.fr');
        $participant3->setPassword($this->passwordHasher->hashPassword(
            $participant3,
            'pass'));
        $participant3->setActif(true);
        $participant3->setCampus($campus);
        $manager->persist($participant3);

        $participant4 = new Participant();
        $participant4->setNom('LALANNE');
        $participant4->setPrenom('Francis');
        $participant4->setPseudo('UnComplotiste');
        $participant4->setTelephone('0109024454');
        $participant4->setEmail('francis@lalanne.fr');
        $participant4->setPassword($this->passwordHasher->hashPassword(
            $participant4,
            'pass'));
        $participant4->setActif(true);
        $participant4->setCampus($campus3);
        $manager->persist($participant4);

        $participant5 = new Participant();
        $participant5->setNom('BIGARD');
        $participant5->setPrenom('Jean-Marie');
        $participant5->setPseudo('JMB');
        $participant5->setTelephone('0109024455');
        $participant5->setEmail('jm@bigard.fr');
        $participant5->setPassword($this->passwordHasher->hashPassword(
            $participant5,
            'pass'));
        $participant5->setActif(true);
        $participant5->setCampus($campus3);
        $manager->persist($participant5);

        $participant6 = new Participant();
        $participant6->setNom('FOÏS');
        $participant6->setPrenom('Marina');
        $participant6->setPseudo('MauvaiseFoïs');
        $participant6->setTelephone('0109024456');
        $participant6->setEmail('marina@burgerquiz.fr');
        $participant6->setPassword($this->passwordHasher->hashPassword(
            $participant6,
            'pass'));
        $participant6->setActif(true);
        $participant6->setCampus($campus);
        $manager->persist($participant6);

        $participant7 = new Participant();
        $participant7->setNom('NANTY');
        $participant7->setPrenom('Isabelle');
        $participant7->setPseudo('CathyTuche');
        $participant7->setTelephone('0109024457');
        $participant7->setEmail('isabelle@burgerquiz.fr');
        $participant7->setPassword($this->passwordHasher->hashPassword(
            $participant7,
            'pass'));
        $participant7->setActif(true);
        $participant7->setCampus($campus);
        $manager->persist($participant7);

        $participant8 = new Participant();
        $participant8->setNom('FARRUGIA');
        $participant8->setPrenom('Dominique');
        $participant8->setPseudo('LePatron');
        $participant8->setTelephone('0109024458');
        $participant8->setEmail('dominique@burgerquiz.fr');
        $participant8->setPassword($this->passwordHasher->hashPassword(
            $participant8,
            'pass'));
        $participant8->setActif(true);
        $participant8->setCampus($campus);
        $manager->persist($participant8);

        $participant9 = new Participant();
        $participant9->setNom('LAUBY');
        $participant9->setPrenom('Chantal');
        $participant9->setPseudo('OnMeVoitOnMeVoitPlus');
        $participant9->setTelephone('0109024459');
        $participant9->setEmail('chantal@burgerquiz.fr');
        $participant9->setPassword($this->passwordHasher->hashPassword(
            $participant9,
            'pass'));
        $participant9->setActif(true);
        $participant9->setCampus($campus);
        $manager->persist($participant9);


        /* ************ VILLE ************ */

        $ville1 = new Ville();
        $ville1->setNom('Aubervilliers');
        $ville1->setCodePostal('93300');
        $manager->persist($ville1);

        $ville2 = new Ville();
        $ville2->setNom('Saint-Herblain');
        $ville2->setCodePostal('44800');
        $manager->persist($ville2);

        $ville3 = new Ville();
        $ville3->setNom('Nantes');
        $ville3->setCodePostal('44000');
        $manager->persist($ville3);

        $ville4 = new Ville();
        $ville4->setNom('Rennes');
        $ville4->setCodePostal('35000');
        $manager->persist($ville4);

        $ville5 = new Ville();
        $ville5->setNom('Mouilleron-le-Captif');
        $ville5->setCodePostal('85000');
        $manager->persist($ville5);


        /* ************ LIEU ************ */

        $lieu1 = new Lieu();
        $lieu1->setNom('Studio 210');
        $lieu1->setRue('11 rue du Grain');
        $lieu1->setLatitude(48.90427017211914);
        $lieu1->setLongitude(2.367272138595581);
        $lieu1->setVille($ville1);
        $manager->persist($lieu1);

        $lieu2 = new Lieu();
        $lieu2->setNom('Zenith Nantes Métropole');
        $lieu2->setRue('ZAC d\'Ar Mor, Bd du Zénith');
        $lieu2->setLatitude(47.2176);
        $lieu2->setLongitude(-1.6484);
        $lieu2->setVille($ville2);
        $manager->persist($lieu2);

        $lieu3 = new Lieu();
        $lieu3->setNom('Cité des Congrès');
        $lieu3->setRue('5 Rue de Valmy');
        $lieu3->setLatitude(47.2133136);
        $lieu3->setLongitude(-1.5440576);
        $lieu3->setVille($ville3);
        $manager->persist($lieu3);

        $lieu4 = new Lieu();
        $lieu4->setNom('Dans la rue');
        $lieu4->setRue('Centre Ville');
        $lieu4->setLatitude(48.1113387);
        $lieu4->setLongitude(-1.6800198);
        $lieu4->setVille($ville4);
        $manager->persist($lieu4);

        $lieu5 = new Lieu();
        $lieu5->setNom('La Longère de Beaupuy');
        $lieu5->setRue('Rue du château de Beaupuy');
        $lieu5->setLatitude(46.71321105957031);
        $lieu5->setLongitude(-1.4358482360839844);
        $lieu5->setVille($ville5);
        $manager->persist($lieu5);

        $lieu6 = new Lieu();
        $lieu6->setNom('La piscine du voison');
        $lieu6->setRue('12 Bd Albert 1er');
        $lieu6->setLatitude(48.0890654);
        $lieu6->setLongitude(-1.6886953);
        $lieu6->setVille($ville4);
        $manager->persist($lieu6);

        $lieu7 = new Lieu();
        $lieu7->setNom('Vendéspace');
        $lieu7->setRue('Rue du Clair Bocage');
        $lieu7->setLatitude(46.7107758);
        $lieu7->setLongitude(-1.4332934);
        $lieu7->setVille($ville5);
        $manager->persist($lieu7);

        /* ************ SORTIE ************ */

        $sortie = new Sortie();
        $sortie->setNom('Burger Quiz');
        $sortie->setDateHeureDebut(new \DateTime("2021-09-10 21:20:00"));
        $sortie->setDuree(50);
        $sortie->setDateLimiteInscription(new \DateTime('2021-09-05'));
        $sortie->setNbInscriptionsMax(6);
        $sortie->setInfosSortie('Prenez une bonne dose de déconne, quelques gouttes de sous-culture, une pincée de repartie servie par 
        des invités triés sur le volet et vous obtenez la recette de ce jeu délirant. Enregistré pour la télé, en légé différé du studio où ils enregistrent pour la 4ème fois en france.');
        $sortie->setEtat($etat2);
        $sortie->setCampus($campus);
        $sortie->setLieu($lieu1);
        $sortie->setOrganisateur($participant2);
        $sortie->addParticipant($participant6);
        $sortie->addParticipant($participant7);
        $sortie->addParticipant($participant8);
        $sortie->addParticipant($participant9);
        $manager->persist($sortie);

        $sortie2 = new Sortie();
        $sortie2->setNom('Concert J.Hallyday');
        $sortie2->setDateHeureDebut(new \DateTime("2018-01-18 20:30:00"));
        $sortie2->setDuree(120);
        $sortie2->setDateLimiteInscription(new \DateTime('2018-01-10'));
        $sortie2->setNbInscriptionsMax(8500);
        $sortie2->setInfosSortie('Pour des raisons évidentes de santé de l\'artiste, la production a été obligée d\'annuler la tournée.');
        $sortie2->setEtat($etat6);
        $sortie2->setCampus($campus);
        $sortie2->setLieu($lieu2);
        $sortie2->setOrganisateur($participant3);
        $manager->persist($sortie2);

        $sortie3 = new Sortie();
        $sortie3->setNom('Manif Anti-Pass');
        $sortie3->setDateHeureDebut(new \DateTime("2021-09-04 14:00:00"));
        $sortie3->setDuree(360);
        $sortie3->setDateLimiteInscription(new \DateTime('2021-09-01'));
        $sortie3->setNbInscriptionsMax(15000);
        $sortie3->setInfosSortie('Rejoignez Jean-Marie Bigard dans son combat contre le pass de la honte. #AllezTousVousFaireEn****r');
        $sortie3->setEtat($etat2);
        $sortie3->setCampus($campus2);
        $sortie3->setLieu($lieu2);
        $sortie3->setOrganisateur($participant5);
        $sortie3->addParticipant($participant4);
        $manager->persist($sortie3);

        $sortie4 = new Sortie();
        $sortie4->setNom('La fin du monde');
        $sortie4->setDateHeureDebut(new \DateTime("2012-12-21 23:59:00"));
        $sortie4->setDuree(1);
        $sortie4->setDateLimiteInscription(new \DateTime('2012-12-15'));
        $sortie4->setNbInscriptionsMax(10);
        $sortie4->setInfosSortie('Observons la collision de la Terre avec un trou noir');
        $sortie4->setEtat($etat5);
        $sortie4->setCampus($campus3);
        $sortie4->setLieu($lieu5);
        $sortie4->setOrganisateur($participant4);
        $manager->persist($sortie4);

        $sortie5 = new Sortie();
        $sortie5->setNom('Spectacle E.Poux');
        $sortie5->setDateHeureDebut(new \DateTime("2021-11-16 20:00:00"));
        $sortie5->setDuree(90);
        $sortie5->setDateLimiteInscription(new \DateTime('2021-07-16'));
        $sortie5->setNbInscriptionsMax(5);
        $sortie5->setInfosSortie('Au travers de personnages tous plus ravagés les uns que les autres, et d’un stand up cyniquement jubilatoire, 
        vous vous surprendrez à rire, à rire, et à rire encore de ses aventures auprès des enfants, des parents, mais aussi des chats et des zombies.
        Si Elodie Poux passe près de chez vous, allez la voir ! Et comme beaucoup de spectateurs avant vous, vous repartirez en vous massant les zygomatiques, 
        vous serez atteint du syndrome du Playmobil !');
        $sortie5->setEtat($etat3);
        $sortie5->setCampus($campus3);
        $sortie5->setLieu($lieu7);
        $sortie5->setOrganisateur($participant1);
        $sortie5->addParticipant($participant2);
        $sortie5->addParticipant($participant6);
        $sortie5->addParticipant($participant7);
        $sortie5->addParticipant($participant8);
        $sortie5->addParticipant($participant9);
        $manager->persist($sortie5);

        $sortie6 = new Sortie();
        $sortie6->setNom('Aqua Jesus');
        $sortie6->setDateHeureDebut(new \DateTime("2021-09-11 16:00:00"));
        $sortie6->setDuree(5);
        $sortie6->setDateLimiteInscription(new \DateTime('2021-09-05'));
        $sortie6->setNbInscriptionsMax(6);
        $sortie6->setInfosSortie('Concours : Marcher le plus longtemps possible sur l\'eau. Tout candidat qui finira noyé se verra exclure du classement final pour abandon.');
        $sortie6->setEtat($etat1);
        $sortie6->setCampus($campus2);
        $sortie6->setLieu($lieu6);
        $sortie6->setOrganisateur($participant1);
        $manager->persist($sortie6);



        // insertion
        $manager->flush();
    }
}
