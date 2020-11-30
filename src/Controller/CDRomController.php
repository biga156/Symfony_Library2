<?php

namespace App\Controller;

use App\Entity\CDRom;
use App\Form\CDRomType;
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
    public function index(CDRomRepository $cDRomRepository): Response
    {
        return $this->render('cd_rom/index.html.twig', [
            'c_d_roms' => $cDRomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="c_d_rom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
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
        if ($this->isCsrfTokenValid('delete'.$cDRom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cDRom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('c_d_rom_index');
    }
}
