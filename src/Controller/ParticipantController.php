<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="participant")
     */
    public function index(): Response
    {
        $partcipant = new Participant();
        $participanForm = $this->createForm(ParticipantType::class, $partcipant);

        return $this->render('participant/participant.html.twig', [
            'participantForm' => $participanForm->createView()
        ]);
    }
}
