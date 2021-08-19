<?php

namespace App\Controller;

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
        return $this->render('sortie/organiser.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }
}
