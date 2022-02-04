<?php

namespace App\Controller;

use App\Entity\Themes;
use App\Form\ThemesType;
use App\Service\Slugify;
use App\Entity\Subthemes;
use App\Repository\ThemesRepository;
use App\Repository\SubthemesRepository;
use App\Repository\RessourcesRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


#[Route('/themes')]
class ThemesController extends AbstractController
{
    #[Route('/', name: 'themes_index', methods: ['GET'])]
    public function index(ThemesRepository $themesRepository): Response
    {
        return $this->render('themes/index.html.twig', [
            'themes' => $themesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'themes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $theme = new Themes();
        $form = $this->createForm(ThemesType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($theme);
            $entityManager->flush();

            return $this->redirectToRoute('themes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('themes/new.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'themes_show', methods: ['GET'])]
    public function show(Themes $theme): Response
    {
        return $this->render('themes/show.html.twig', [
            'theme' => $theme,
        ]);
    }

    #[Route('/{id}/edit', name: 'themes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Themes $theme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThemesType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('themes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('themes/edit.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'themes_delete', methods: ['POST'])]
    public function delete(Request $request, Themes $theme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->request->get('_token'))) {
            $entityManager->remove($theme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('themes_index', [], Response::HTTP_SEE_OTHER);
    }


    // Renvoie tous les thèmes et le nom du thème choisi

    #[Route('/{currentTheme}', name: 'show_currentTheme', methods: ['GET'])]
    #[ParamConverter('currentTheme', options: ['mapping' => ['currentTheme' => 'name']])]
    public function showCurrentTheme(
        Themes $currentTheme,
        ThemesRepository $themesRepository,
    ): Response {

        return $this->render('subthemes/theme.html.twig', [
            'currentTheme' => $currentTheme,
            'allThemes' => $themesRepository->findAll(),
        ]);
    }

    #[Route('/{currentTheme}/{currentSubtheme}', name: 'show_ressoucesInSubtheme', methods: ['GET'])]
    #[ParamConverter('currentTheme', options: ['mapping' => ['currentTheme' => 'name']])]
    #[ParamConverter('currentSubtheme', options: ['mapping' => ['currentSubtheme' => 'name']])]
    public function showRessourcesInSubtheme (
        Themes $currentTheme,
        Subthemes $currentSubtheme,
        RessourcesRepository $ressourcesRepository
    ): Response {

        return $this->render('subthemes/theme_subtheme.html.twig', [
                    'currentTheme' => $currentTheme,
                    'currentSubtheme' => $currentSubtheme,
                    'ressourcesVideo' => $ressourcesRepository->findBy(array('type' => 'Vidéo', 'subtheme' => $currentSubtheme->getId()),),
                    'ressourcesCours' => $ressourcesRepository->findBy(array('type' => 'Cours', 'subtheme' => $currentSubtheme->getId()),),
                    'ressourcesLiens' => $ressourcesRepository->findBy(array('type' => 'Lien utile', 'subtheme' => $currentSubtheme->getId()),)

                ]);
    }

}
