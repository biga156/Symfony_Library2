<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Form\SearchType;
use App\Entity\Rechercher;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository, Request $request): Response
    {


        $search = new Rechercher();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitre();
            $authtor = $form->getData()->getAuthor();
            $cote = $form->getData()->getCote();


            if (empty($title) && empty($author) && empty($cote)) {
                $this->addFlash('erreur', 'Aucun article contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');
            }
            return $this->render('livre/index.html.twig', [
                'livres' => $livreRepository->findLivre($title, $authtor, $cote),
                'form' => $form->createView()
            ]);
        }


        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/new", name="livre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_show", methods={"GET"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    /**
     * @IsGranted("ROLE_VOLONTEER")
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_index');
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="livre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index');
    }

    public function searchLivre(Request $request)
    {
        $livre = null;
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $title = $form->getData()["title"];
            $livre = $this->getDoctrine()->getManager()->getRepository(Livre::class)->findBy(["title" => $title]);
        }
        return $this->render('livre/index.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }
}
