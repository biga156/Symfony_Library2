<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//composer require sensio/framework-extra-bundle

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
  
    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(UserPasswordEncoderInterface $encoder,Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Permet de crypter le mot de passe 
            $motDePasse = $encoder->encodePassword($user, $user->getPassword()); 
            
            //Envoi le mot de passe crypté
            $user->setPassword($motDePasse); 

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

/**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/{id}", name="account_show", methods={"GET"})
     */
    public function userShow(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
 
    /**
     * NOTE: Permet d'éditer le profil de l'utilisateur connecté 
     * @Security("is_granted('ROLE_USER') and user == user.id()", message="Vous n'avez pas le droit à acceder à cette resources")
     * @Route("/{id}/edit", name="account_edit", methods={"GET","POST"})
     */
    public function userEdit(UserPasswordEncoderInterface $encoder,Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Permet de crypter le mot de passe 
            $motDePasse = $encoder->encodePassword($user, $user->getPassword()); 
            
            //Envoi le mot de passe crypté
            $user->setPassword($motDePasse); 

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
