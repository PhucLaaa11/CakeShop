<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }

    #[Route('/customer/create', name: 'app_customer_create', priority: 1)]
    public function createAction(CustomerRepository $customerRepository, Request $request): Response
    {

        $form = $this->createForm(CustomerType::class, new  Customer());
//        dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $customerRepository->save($customer, true);
            $this->addFlash('success', 'Customer\'s inserted successfully');
            return $this->redirectToRoute('app_customer_all');
        }

        return $this->render('customer/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/customer/all', name: 'app_customer_all')]
    public function getCustomer(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();
        //dd($customers);
        return $this->render('customer/index.html.twig',
            ['customers' => $customers]);
    }
}