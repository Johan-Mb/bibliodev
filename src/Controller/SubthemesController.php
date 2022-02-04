<?php

namespace App\Controller;

use App\Entity\Subthemes;
use App\Form\SubthemesType;
use App\Repository\ThemesRepository;
use App\Repository\SubthemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubthemesController extends AbstractController
{
    #[Route('/subthemes', name: 'subthemes_index', methods: ['GET'])]
    public function index(SubthemesRepository $subthemesRepository, ThemesRepository $themesRepository): Response
    {
        return $this->render('subthemes/index.html.twig', [
            'subthemes' => $subthemesRepository->findAll(),
            'themes' => $themesRepository->findAll(),
        ]);
    }

    #[Route('/subthemes/new', name: 'subthemes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subtheme = new Subthemes();
        $form = $this->createForm(SubthemesType::class, $subtheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subtheme);
            $entityManager->flush();

            return $this->redirectToRoute('subthemes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subthemes/new.html.twig', [
            'subtheme' => $subtheme,
            'form' => $form,
        ]);
    }

    #[Route('/subthemes/{id}', name: 'subthemes_show', methods: ['GET'])]
    public function show(Subthemes $subtheme): Response
    {
        return $this->render('subthemes/show.html.twig', [
            'subtheme' => $subtheme,
        ]);
    }

    #[Route('/subthemes/{id}/edit', name: 'subthemes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subthemes $subtheme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubthemesType::class, $subtheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('subthemes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subthemes/edit.html.twig', [
            'subtheme' => $subtheme,
            'form' => $form,
        ]);
    }

    #[Route('/subthemes/{id}', name: 'subthemes_delete', methods: ['POST'])]
    public function delete(Request $request, Subthemes $subtheme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subtheme->getId(), $request->request->get('_token'))) {
            $entityManager->remove($subtheme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subthemes_index', [], Response::HTTP_SEE_OTHER);
    }
}
