<?php

namespace App\Controller;
use App\Entity\Participant;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
USE Symfony\component\httpFoundation\rquest;
use ContainerDKgBEMY\getParticipantControllerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route(path="edit/profil", name="edit", methods={"GET", "POST"})
     *
     */
    public function Edit( Request $request, EntityManagerInterface $em)
    {
        $userSession = $this->getUser();
        $participant = $em->getRepository('App:Participant')->findOneBy(['email'=>$userSession->getUserIdentifier()]);
        $participantForm=$this->createForm(ParticipantType::class, $participant);

        $participantForm->add('create', SubmitType::class, [
            'label'=>'Enregistrer']);

        $participantForm->handleRequest($request);
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
            $participantForm=$participantForm->getData();


            $em->persist($participantForm);

            $this->addFlash('Success', 'Profil participant modifie!');
            return $this->redirectToRoute('admin_participant_edit', [
                'id' => $participantForm->getId(),
            ]);
        }

        return $this->render('participant/participant.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }
}