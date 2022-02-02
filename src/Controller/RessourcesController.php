<?php

namespace App\Controller;

use App\Entity\Ressources;
use App\Form\RessourcesType;
use App\Repository\RessourcesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchRessourcesType;


#[Route('/ressources')]
class RessourcesController extends AbstractController
{
    #[Route('/', name: 'ressources_index', methods: ['POST','GET'])]
    public function index(Request $request, RessourcesRepository $ressourcesRepository): Response
    {
        $form = $this->createForm(SearchRessourcesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $ressource = $ressourcesRepository->findLikeName($search);
        } else {
            $ressource = $ressourcesRepository->findAll();
        }

        return $this->render('ressources/index.html.twig', [
            'ressources' => $ressource,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'ressources_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ressource = new Ressources();
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('ressources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressources/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ressources_show', methods: ['GET'])]
    public function show(Ressources $ressource): Response
    {
        return $this->render('ressources/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    #[Route('/{id}/edit', name: 'ressources_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressources $ressource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('ressources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressources/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'ressources_delete', methods: ['POST'])]
    public function delete(Request $request, Ressources $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ressources_index', [], Response::HTTP_SEE_OTHER);
    }
}
