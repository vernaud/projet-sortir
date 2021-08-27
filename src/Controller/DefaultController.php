<?php


namespace App\Controller;


use App\Form\RechercheType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return Response
     */
    public function home(Request $request, SortieRepository $sortieRepository): Response
    {

        $searchForm = $this->createForm(RechercheType::class);
        $searchForm->handleRequest($request);


        if ($searchForm->isSubmitted()){

            $filtres = $searchForm->getData();
            $participant = $this->getUser();
            $sorties = $sortieRepository->defaultFind($filtres, $participant);

        } else {

            $participant = $this->getUser();
            $sorties = $sortieRepository->findAllSorties($participant);

        }


        return $this->render('default/home.html.twig', [
            "sorties" => $sorties,
            'formRecherche' => $searchForm->createView()]);
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