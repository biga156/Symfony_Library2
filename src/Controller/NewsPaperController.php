<?php

namespace App\Controller;

use App\Entity\NewsPaper;
use App\Form\NewsPaperType;
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
    public function index(NewsPaperRepository $newsPaperRepository): Response
    {
        return $this->render('news_paper/index.html.twig', [
            'news_papers' => $newsPaperRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="news_paper_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
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
        if ($this->isCsrfTokenValid('delete'.$newsPaper->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsPaper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('news_paper_index');
    }
}
