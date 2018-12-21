<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout(): void
    {
        throw new \Exception('Cette exception n\'est jamais utilisé!');
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        //instanciation d'un client
        $unClient = new Client();

        //creation du formulaire en fonction de client
        $form = $this->createFormBuilder($unClient)
            ->add('identifiant', TextType::class)
            ->add('motDePasse', PasswordType::class)
            //attribut qu'on ajoute dans la classe client pour la confirmation du mdp
            ->add('save', SubmitType::class, array('label' => 'Add user'))
            ->getForm();

        //reccupere la requete
        $form->handleRequest($request);

        //test si le formulaire est soumise
        if ($form->isSubmitted() && $form->isValid()) {
            //test et hache le mdp
            $password = $passwordEncoder->encodePassword($unClient, $unClient->getPassword());

            //affecte le mot de passe au client
            $unClient->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();

            //envoi le nouveau client a la bdd
            $entityManager->persist($unClient);
            $entityManager->flush();

            //redirige l'utilisateur vers la route de connexion
            return $this->redirectToRoute('connexion');
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView(),
            'title' => 'inscription',
        ]);
    }

    //route connexion
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        //creer un formulaire de nulle part
        $form = $this->get('form.factory')
            ->createNamedBuilder(null)
            ->add('_username', TextType::class, ['label' => 'Identifiant'])
            ->add('_password', PasswordType::class, ['label' => 'Mot de passe'])
            ->add('ok', SubmitType::class, ['label' => 'Ok', 'attr' => ['class' => 'btn-primary btn-block']])
            ->getForm();

        return $this->render('security/connexion.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'title' => 'connexion',
        ]);
    }





}
