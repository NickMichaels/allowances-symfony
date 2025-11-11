<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Transaction;
use App\Form\TransactionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/transaction')]
final class TransactionController extends AbstractController
{
    #[Route('/account_transactions/{id}', name: 'account_transactions', methods: ['GET'])]
    public function index(TransactionRepository $transactionRepository, Account $account): Response
    {
        $transactions = $transactionRepository->findBy(['account' => $account]);
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactions,
            'account' => $account,
        ]);
    }

    /*
    #[Route('/holder_accounts/{id}', name: 'holder_accounts', methods: ['GET'])]
    public function index(AccountRepository $accountRepository, Holder $holder): Response
    {
        $accounts = $accountRepository->findBy(['holder' => $holder]);
        return $this->render('account/index.html.twig', [
            'accounts' => $accounts,
        ]);
    }*/

    #[Route('/new/{account}', name: 'app_transaction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Account $account, EntityManagerInterface $entityManager): Response
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction->setAccount($account);
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('account_transactions', ['id' => $account->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transaction/new.html.twig', [
            'transaction' => $transaction,
            'account' => $account,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transaction_show', methods: ['GET'])]
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transaction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transaction_delete', methods: ['POST'])]
    public function delete(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transaction_index', [], Response::HTTP_SEE_OTHER);
    }
}
