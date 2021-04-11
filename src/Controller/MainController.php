<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="main_")
 */
class MainController extends AbstractController
{

    /**
     * @Route("", name="home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }


    /**
     * @Route("/apropos", name="apropos")
     */
    public function aPropos()
    {
        return $this->render('main/apropos.html.twig');
    }
}
