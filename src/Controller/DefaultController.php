<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route (path="/", name="default_")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route(path="", name="index", methods={"GET"})
     * @Route(path="home", name="home", methods={"GET"})
     */
    public function home() {
        return $this->render('default/home.html.twig');
    }


}