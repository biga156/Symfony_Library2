<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Entity\MicroFilm;
use App\Entity\Rechercher;
use App\Form\MicroFilmType;
use App\Repository\MicroFilmRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/micro/film")
 */
class MicroFilmController extends AbstractController
{

    /**
     * @Route("/", name="micro_film_index", methods={"GET"})
     */
    public function index(MicroFilmRepository $microFilmRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $microFilmRepository->findAll();
        $micro_films = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );

        $search = new Rechercher();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitre();
            $cote = $form->getData()->getCote();



            if (empty($title) && empty($cote)) {
                $this->addFlash('erreur', 'Aucun article contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');
            }

            return $this->render('micro_film/index.html.twig', [
                'micro_films' => $microFilmRepository->findMicroFilm($title, $cote),
                'form' => $form->createView()
            ]);
        }


        return $this->render('micro_film/index.html.twig', [
            'micro_films' => $micro_films,
            'form' => $form->createView()

        ]);
    }
 /**
     * @Route("/new", name="micro_film_new", methods={"GET","POST"})
     */

    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $microFilm = new MicroFilm();
        $form = $this->createForm(MicroFilmType::class, $microFilm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($microFilm);
            $entityManager->flush();

            return $this->redirectToRoute('micro_film_index');
        }

        return $this->render('micro_film/new.html.twig', [
            'micro_film' => $microFilm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="micro_film_show", methods={"GET"})
     */
    public function show(MicroFilm $microFilm): Response
    {
        return $this->render('micro_film/show.html.twig', [
            'micro_film' => $microFilm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="micro_film_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MicroFilm $microFilm): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $form = $this->createForm(MicroFilmType::class, $microFilm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('micro_film_index');
        }

        return $this->render('micro_film/edit.html.twig', [
            'micro_film' => $microFilm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="micro_film_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MicroFilm $microFilm): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete' . $microFilm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($microFilm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('micro_film_index');
    }
}
