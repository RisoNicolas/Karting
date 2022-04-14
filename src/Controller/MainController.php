<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController

{
    /**
     * @Route("/", name="main_accueil")
     */
    public function accueil(): Response
    {
        return $this->render('main/acceuil.html.twig', [
        ]);
    }

    /**
     * @Route("/edition", name="admin_edition")
     */
    public function edition(): Response
    {
        return $this->render('editerAdmin/edition.html.twig', [
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(Session $session)
    {
        $utilisateur = $this->getUser();
        if(!$utilisateur)
        {
            $session->set("message", "Merci de vous connecter");
            return $this->redirectToRoute('login');
        }

        else if(in_array('ROLE_ADMIN', $utilisateur->getRoles())){
            return $this->render('main/admin.html.twig');
        }
        $session->set("message", "Vous n'avez pas le droit d'acceder à la page admin vous avez été redirigé sur cette page");
        if($session->has('message'))
        {
            $message = $session->get('message');
            $session->remove('message'); //on vide la variable message dans la session
            $return['message'] = $message; //on ajoute à l'array de paramètres notre message
        }
        return $this->redirectToRoute('main_accueil', $return );

    }

}