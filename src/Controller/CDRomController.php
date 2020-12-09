<?php

namespace App\Controller;

use App\Entity\CDRom;
use App\Form\CDRomType;
use App\Entity\Rechercher;
use App\Form\SearchType;
use App\Repository\CDRomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/c/d/rom")
 */
class CDRomController extends AbstractController
{
    /**
     * @Route("/", name="CD_index", methods={"GET"})
     */
    public function index(CDRomRepository $cDRomRepository, Request $request): Response
    {

        $search = new Rechercher();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitre();
            $author = $form->getData()->getAuthor();



            if (empty($title) && empty($author)) {
                $this->addFlash('erreur', 'Aucun article contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');
            }

            return $this->render('cd_rom/index.html.twig', [
                'c_d_roms' => $cDRomRepository->findCdrom($title, $author),
                'form' => $form->createView()
            ]);
        }

        return $this->render('cd_rom/index.html.twig', [
            'c_d_roms' => $cDRomRepository->findAll(),
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/new", name="c_d_rom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $cDRom = new CDRom();
        $form = $this->createForm(CDRomType::class, $cDRom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cDRom);
            $entityManager->flush();

            return $this->redirectToRoute('c_d_rom_index');
        }

        return $this->render('cd_rom/new.html.twig', [
            'c_d_rom' => $cDRom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="c_d_rom_show", methods={"GET"})
     */
    public function show(CDRom $cDRom): Response
    {
        return $this->render('cd_rom/show.html.twig', [
            'c_d_rom' => $cDRom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="c_d_rom_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CDRom $cDRom): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VOLONTEER');
        $form = $this->createForm(CDRomType::class, $cDRom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('c_d_rom_index');
        }

        return $this->render('cd_rom/edit.html.twig', [
            'c_d_rom' => $cDRom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="c_d_rom_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CDRom $cDRom): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete' . $cDRom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cDRom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('c_d_rom_index');
    }
}
