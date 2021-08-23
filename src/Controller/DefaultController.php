<?php


namespace App\Controller;


use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route (path="/", name="default_")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route(path="", name="index", methods={"GET", "POST"})
     * @Route(path="home", name="home", methods={"GET", "POST"})
     */
    public function home(Request $request, SortieRepository $sortieRepository): Response {

        // Création du formulaire
        $searchForm = $this->createForm('App\Form\RechercheType');
        $sorties = $sortieRepository->findAllSorties();

        // Traitement
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() ){

            return $this->redirectToRoute('default_home');
        }


        return $this->render('default/home.html.twig', ["sorties" => $sorties, 'formRecherche' => $searchForm->createView()]);
    }

//    /**
//     * @Route("/test", name="main_test")
//     */
//    public function test() {
//
//        $sortie = [
//            "nom" => "nom de la sortie",
//            "duree" => 90,
//        ];
//
//        return $this->render('default/home.html.twig', [
//            "maSortie" => $sortie,
//        ]);
//
//    }


}