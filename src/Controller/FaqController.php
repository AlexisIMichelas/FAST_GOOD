<?php

namespace App\Controller;

use App\Entity\FAQ;
use App\Form\FAQType;
use App\Repository\FAQRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/f/a/q')]
class FAQController extends AbstractController
{
    #[Route('/faq', name: 'app_faq', methods: ['GET'])]
    public function index(FAQRepository $fAQRepository): Response
    {
        return $this->render('faq/index.html.twig', [
            'f_a_qs' => $fAQRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_f_a_q_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fAQ = new FAQ();
        $form = $this->createForm(FAQType::class, $fAQ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fAQ);
            $entityManager->flush();

            return $this->redirectToRoute('app_f_a_q_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('faq/new.html.twig', [
            'f_a_q' => $fAQ,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_f_a_q_show', methods: ['GET'])]
    public function show(FAQ $fAQ): Response
    {
        return $this->render('faq/show.html.twig', [
            'f_a_q' => $fAQ,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_f_a_q_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FAQ $fAQ, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FAQType::class, $fAQ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_f_a_q_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('faq/edit.html.twig', [
            'f_a_q' => $fAQ,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_f_a_q_delete', methods: ['POST'])]
    public function delete(Request $request, FAQ $fAQ, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fAQ->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fAQ);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_f_a_q_index', [], Response::HTTP_SEE_OTHER);
    }
}
