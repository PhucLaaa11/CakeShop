<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
    #[Route('/supplier/create', name: 'app_supplier_create', priority: 1)]
    public function createAction(SupplierRepository $supplierRepository, Request $request): Response
    {

        $form = $this->createForm(SupplierType::class, new  Supplier());

//        dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplier = $form->getData();
            $supplierRepository->save($supplier, true);
            $this->addFlash('success', 'Supplier\'s inserted successfully');
            return $this->redirectToRoute('app_supplier_all');
        }

        return $this->render('supplier/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/supplier/all', name: 'app_supplier_all')]
    public function getCustomer(SupplierRepository $supplierRepository): Response
    {
        $suppliers = $supplierRepository->findAll();
        return $this->render('supplier/index.html.twig',
            ['suppliers' => $suppliers]);
    }

}