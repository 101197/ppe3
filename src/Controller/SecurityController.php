<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add('identifiant', TextType::class, [
                'label' => 'Identifiant',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre identifiant',
                ]
            ])


            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Les deux emails ne corespondent pas',
                'required' => true,
                'first_options' => [
                    'label' => 'Email',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre adresse mail',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmation de l\'email',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Confirmez votre adresse mail',
                    ],
                ]
            ])

            ->add('motDePasse', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe ne corespondent pas',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre mot de passe',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Confirmez votre mot de passe',
                    ],
                ]
            ])

            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre nom',
                ]
            ])

            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre prénom',
                ]
            ])

            ->add('telephone', NumberType::class, [
                'label' => 'Telephone',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre numero de telephone',
                ]
            ])

            //attribut qu'on ajoute dans la classe client pour la confirmation du mdp
            ->add('save', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
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
