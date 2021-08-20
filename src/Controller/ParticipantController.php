<?php

namespace App\Controller;
use App\Entity\Participant;
use App\Form\ParticipantType;
use ContainerDKgBEMY\getParticipantControllerService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route(path="profil/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager)
    {

        try {

            $partcipant = $entityManager->getRepository('App:Participant');

        } catch (NonUniqueResultException | NoResultException $partcipant) {
            throw $this->createNotFoundException('participant!');
        }

        $formParticipant = $this->createForm('App\Form\ParticipantType');
        $formParticipant->handleRequest($request);

        if ($formParticipant->isSubmitted() && $formParticipant->isValid()) {
            // Censure
            $partcipant->setDescription($partcipant->purify($partcipant->getDescription()));

            $entityManager->persist($partcipant);
            $entityManager->flush();

            $this->addFlash('Success', 'Profil modifie!');
            return $this->redirectToRoute('default_home', ['id' => $partcipant->getId()]);
        }

        return $this->render('participant/participant.html.twig', [
            'form' => $formParticipant->createView(),
        ]);
    }
}