<?php


namespace App\Controller;


use App\Form\RechercheType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @return Response
     */
    public function home(Request $request, SortieRepository $sortieRepository): Response
    {

//        $filtres = [];
        $searchForm = $this->createForm(RechercheType::class);
        $searchForm->handleRequest($request);


        if ($searchForm->isSubmitted()){

            /*$filtres = [
                'campus'=>$request->get('recherche'),
                'search'=>$request->get('search'),
                'dateUn'=>$request->get('dateUn'),
                'dateDeux'=>$request->get('dateDeux'),
                'sortieOrganisateur'=>$request->get('sortieOrganisateur'),
                'sortieInscrit'=>$request->get('sortieInscrit'),
                'sortiePasInscrit'=>$request->get('sortiePasInscrit'),
                'sortiePassees'=>$request->get('sortiePassees')
            ];*/

            $filtres = $searchForm->getData();
            $participant = $this->getUser();
            $sorties = $sortieRepository->defaultFind($filtres, $participant);

        } else {

            $sorties = $sortieRepository->findAll();

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