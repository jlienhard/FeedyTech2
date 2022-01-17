<?php

namespace App\Controller\Admin;

use App\Entity\Sites;
use App\Form\SitesType;
use App\Repository\SitesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/sites')]
class SitesController extends AbstractController
{
    #[Route('/', name: 'admin_sites_index', methods: ['GET'])]
    public function index(SitesRepository $sitesRepository): Response
    {
        return $this->render('admin/sites/index.html.twig', [
            'sites' => $sitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_sites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $site = new Sites();
        $form = $this->createForm(SitesType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($site);
            $entityManager->flush();

            return $this->redirectToRoute('admin_sites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sites/new.html.twig', [
            'site' => $site,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_sites_show', methods: ['GET'])]
    public function show(Sites $site): Response
    {
        return $this->render('admin/sites/show.html.twig', [
            'site' => $site,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_sites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sites $site, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SitesType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_sites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sites/edit.html.twig', [
            'site' => $site,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_sites_delete', methods: ['POST'])]
    public function delete(Request $request, Sites $site, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$site->getId(), $request->request->get('_token'))) {
            $entityManager->remove($site);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_sites_index', [], Response::HTTP_SEE_OTHER);
    }
}
