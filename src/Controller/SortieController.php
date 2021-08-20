<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\SortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/organiser", name="organiser")
     */
    public function organiser(Request $request): Response
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


            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('default_home');
        }

        // envoi du formulaire vers la view
        return $this->render('sortie/organiser.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }
}