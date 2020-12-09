<?php

namespace App\Controller;

use App\Entity\NewsPaper;
use App\Form\NewsPaperType;
use App\Form\SearchType;
use App\Entity\Rechercher;
use App\Repository\NewsPaperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news/paper")
 */
class NewsPaperController extends AbstractController
{
    /**
     * @Route("/", name="news_paper_index", methods={"GET"})
     */
    public function index(NewsPaperRepository $newsPaperRepository, Request $request): Response
    {

        $search = new Rechercher();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitre();
            $cote = $form->getData()->getCote();



            if (empty($title) && empty($cote)) {
                $this->addFlash('erreur', 'Aucun article contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');
            }

            return $this->render('news_paper/index.html.twig', [
                'news_papers' => $newsPaperRepository->findNewsPaper($title,$cote),
                'form' => $form->createView()
            ]);

            }
        return $this->render('news_paper/index.html.twig', [
            'news_papers' => $newsPaperRepository->findAll(),
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/new", name="news_paper_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $newsPaper = new NewsPaper();
        $form = $this->createForm(NewsPaperType::class, $newsPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsPaper);
            $entityManager->flush();

            return $this->redirectToRoute('news_paper_index');
        }

        return $this->render('news_paper/new.html.twig', [
            'news_paper' => $newsPaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_paper_show", methods={"GET"})
     */
    public function show(NewsPaper $newsPaper): Response
    {
        return $this->render('news_paper/show.html.twig', [
            'news_paper' => $newsPaper,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_paper_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewsPaper $newsPaper): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $form = $this->createForm(NewsPaperType::class, $newsPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_paper_index');
        }

        return $this->render('news_paper/edit.html.twig', [
            'news_paper' => $newsPaper,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_paper_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NewsPaper $newsPaper): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete'.$newsPaper->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsPaper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('news_paper_index');
    }
}
