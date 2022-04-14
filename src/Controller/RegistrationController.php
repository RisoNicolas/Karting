<?php



namespace App\Controller;
use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Session $session, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {

        $utilisateur = new Utilisateur();
        $utilisateurForm = $this->createForm(RegistrationFormType::class, $utilisateur);
        $utilisateurForm->handleRequest($request);
        if ($utilisateurForm->isSubmitted() && $utilisateurForm->isValid()) {
            // encode the plain password
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $utilisateurForm->get('password')->getData()
                )
            );
            $utilisateur->setRoles(["ROLE_USER"]);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            // do anything else you need here, like send an email
            return $userAuthenticator->authenticateUser(
                $utilisateur,
                $authenticator,
                $request
            );
            $this->addFlash('success', 'Compte créé !');
            return $this->redirectToRoute('main_acceuil',['id' => $utilisateur->getId()]);
        }
        return $this->render('registration/register.html.twig', [
            'utilisateurForm'=>$utilisateurForm->createView()
        ]);
    }
}