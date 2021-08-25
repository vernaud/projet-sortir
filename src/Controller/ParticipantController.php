<?php

namespace App\Controller;
use App\Entity\Participant;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/edit/profil", name="edit",  requirements={"id" = "\d+"}, methods={"GET", "POST"})
     *
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher):Response
    {
        $partcipantRapository = $this->getDoctrine()->getRepository(Participant::class);
        $participant = $partcipantRapository->findOneBy( ['id'=>$this->getUser()] );
        dump($participant);
        $oldPassword = $participant->getPassword();
        $participantForm = $this->createForm(ParticipantType::class, $participant);
        $participantForm->add('create', SubmitType::class, [
            'label' => 'Enregistrer']);

        $participantForm->handleRequest($request);

        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
//            dump($participant);exit;
            if($participant->getPassword() != $oldPassword) {
                $newHashedPassword = $hasher->hashPassword($participant, $participant->getPassword());
                $participant->setPassword($newHashedPassword);
            }


            $entityManager->persist($participant);
            $entityManager->flush();
            return $this->redirectToRoute('edit');

        }

        return $this->render('participant/participant.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }
}
