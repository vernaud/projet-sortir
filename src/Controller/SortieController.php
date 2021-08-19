<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function organiser(): Response
    {
        // Instancier SortieType
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);

        // todo traitement du formulaire

        // envoi du formulaire vers la view
        return $this->render('sortie/organiser.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }
}
