<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/organiser", name="organiser")
     */
    public function create(Request $request): Response
    {
        // Instancier SortieType
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        // Ajouter le submit
        $sortieForm->add('create', SubmitType::class, [
            'label'=>'Enregistrer']);


        $sortieForm->handleRequest($request);

        // Traitement du formulaire s'il est soumis
        if ($sortieForm->isSubmitted() ){
            $em = $this->getDoctrine()->getManager();
            $participantRepository=$em->getRepository(Participant::class);
            $etatRepository=$em->getRepository(Etat::class);
            $campusRepository=$em->getRepository(Campus::class);

            $participant= $participantRepository->findOneBy(['email'=>$this->getUser()->getUserIdentifier()]);
            $sortie->setOrganisateur($participant);
            $sortie->setCampus($participant->getCampus());

            $etat= $etatRepository->findOneBy(['libelle'=>'Créée']);
            $sortie->setEtat($etat);

            if ($sortie->getDateHeureDebut() < $sortie->getDateLimiteInscription()){

                $this->addFlash('alert', 'Les inscriptions doivent se terminer avant la sortie.');
                return $this->redirectToRoute('sortie_organiser');
            }

            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success', 'La sortie est enregistrée.');
            return $this->redirectToRoute('default_home');
        }

        // envoi du formulaire vers la view
        return $this->render('sortie/organiser.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @Route("/edit-{id}", name="edit", requirements={"id": "\d+"}, methods={"GET", "POST"})
     */
    public function edit(Request $request): Response
    {

        // Récupération de l'objet sortie
        $sortieRepository = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepository->findOneBy( ['id'=> $request->get('id')] );

        // Etat == Créée ? Suis-je l'organisateur ?
//        $this->isValidEtatOrganisateur($sortie);

        if ( ($sortie->getEtat()->getLibelle() != 'Créée') || ($sortie->getOrganisateur() != $this->getUser()) ){
            return $this->redirectToRoute('default_home');
        }


        // Création du formulaire
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        // Ajouter le submit
        $sortieForm->add('create', SubmitType::class, [
            'label'=>'Enregistrer']);


        $sortieForm->handleRequest($request);

        // Traitement du formulaire s'il est soumis
        if ($sortieForm->isSubmitted() ){
            $em = $this->getDoctrine()->getManager();

            if ($sortie->getDateHeureDebut() < $sortie->getDateLimiteInscription()){

                $this->addFlash('alert', 'Les inscriptions doivent se terminer avant la sortie.');
                return $this->redirectToRoute('sortie_organiser');
            }

            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success', 'La sortie est mise à jour.');
            return $this->redirectToRoute('default_home');
        }

        // envoi du formulaire vers la view
        return $this->render('sortie/organiser.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @Route("/afficher-{id}", name="afficher", requirements={"id": "\d+"}, methods={"GET", "POST"})
     */
    public function afficher(Request $request): Response
    {

        // Récupération de l'objet sortie
        $sortieRepository = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepository->findOneBy( ['id'=> $request->get('id')] );

        // Redirection
        return $this->render('sortie/afficher.html.twig', [
            'sortie'=>$sortie,
        ]);
    }

    /**
     * @Route("/publier-{id}", name="publier", requirements={"id": "\d+"}, methods={"GET", "POST"})
     */
    public function publier(Request $request): Response
    {

        // Récupération de l'objet sortie
        $sortieRepository = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepository->findOneBy( ['id'=> $request->get('id')] );



//        $this->isValidEtatOrganisateur($sortie);
        if ( ($sortie->getEtat()->getLibelle() != 'Créée') || ($sortie->getOrganisateur() != $this->getUser()) ){
            return $this->redirectToRoute('default_home');
        }



        // Changement de l'état
        $etatRepository=$this->getDoctrine()->getRepository(Etat::class);
        $etat= $etatRepository->findOneBy(['libelle'=>'Ouverte']);
        $sortie->setEtat($etat);

        // flush
        $em = $this->getDoctrine()->getManager();
        $em->persist($sortie);
        $em->flush();


        // Redirection
        return $this->redirectToRoute('default_home');
    }

    /**
     * @Route("/inscription", name="inscription", requirements={"id": "\d+"})
     */
    public function inscription(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Récupération de l'identifiant
        $id = (int) $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $sortie = $entityManager->getRepository('App:Sortie')->getSortieById($id);
        $date = new \DateTime("now");

        if ( $sortie->getParticipants()->count() < $sortie->getNbInscriptionsMax()
            && $sortie->getEtat()->getLibelle() == "Ouverte"
            && $sortie->getDateLimiteInscription() > $date
        ){
            $user = $this->getUser();
            $sortie->addParticipant($user);
            $em->persist($sortie);
            $em->flush();
        }


        return $this->redirectToRoute('default_home');
    }

    /**
     * @Route("/desistement", name="desistement", requirements={"id": "\d+"})
     */
    public function desistement(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Récupération de l'identifiant
        $id = (int) $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $sortie = $entityManager->getRepository('App:Sortie')->getSortieById($id);
        $date = new \DateTime("now");

        if ( ($sortie->getEtat()->getLibelle() == "Ouverte" || $sortie->getEtat()->getLibelle() == "Clôturée")
            && $sortie->getDateLimiteInscription() > $date
        ){
            $user = $this->getUser();
            $sortie->removeParticipant($user);
            $em->persist($sortie);
            $em->flush();
        }



        return $this->redirectToRoute('default_home');
    }

    public function isValidEtatOrganisateur(Request $request, $sortie) :Response
    {
        dump($sortie);
        dump($sortie->getEtat()->getLibelle());
        dump($sortie->getOrganisateur());
        dump($this->getUser());

        if ( ($sortie->getEtat()->getLibelle() != 'Créée') || ($sortie->getOrganisteur() != $this->getUser()) ){
            return $this->redirectToRoute('default_home');
        }
    }
}
