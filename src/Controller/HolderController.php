<?php

namespace App\Controller;

use App\Entity\Holder;
use App\Form\HolderType;
use App\Repository\HolderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/holder')]
final class HolderController extends AbstractController
{
    #[Route(name: 'app_holder_index', methods: ['GET'])]
    public function index(HolderRepository $holderRepository): Response
    {
        return $this->render('holder/index.html.twig', [
            'holders' => $holderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_holder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $holder = new Holder();
        $form = $this->createForm(HolderType::class, $holder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($holder);
            $entityManager->flush();

            return $this->redirectToRoute('app_holder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('holder/new.html.twig', [
            'holder' => $holder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_holder_show', methods: ['GET'])]
    public function show(Holder $holder): Response
    {
        return $this->render('holder/show.html.twig', [
            'holder' => $holder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_holder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Holder $holder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HolderType::class, $holder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_holder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('holder/edit.html.twig', [
            'holder' => $holder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_holder_delete', methods: ['POST'])]
    public function delete(Request $request, Holder $holder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$holder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($holder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_holder_index', [], Response::HTTP_SEE_OTHER);
    }
}
