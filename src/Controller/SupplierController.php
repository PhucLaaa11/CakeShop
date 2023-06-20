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
    #[Route('/supplier', name: 'app_supplier')]
    public function index(): Response
    {
        return $this->render('supplier/index.html.twig', [
            'Supplier' => 'SupplierController',
        ]);
    }

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

    #[Route('/supplier/edit/{id}', name: 'app_supplier_edit')]
    public function editAction(Request $request, SupplierRepository $supplierRepository, Supplier $supplier): Response
    {
        $form = $this->createForm(SupplierType::class, $supplier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplier = $form->getData();
            $supplierRepository->save($supplier, true);

            $this->addFlash('success', 'Supplier\'s updated successfully');
            return $this->redirectToRoute('app_supplier_all');
        }

        return $this->render('supplier/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/supplier/delete/{id}', name: 'app_supplier_delete')]
    public function deleteAction(Supplier $supplier, SupplierRepository $supplierRepository): Response
    {
        $supplierRepository->remove($supplier, true);
        $this->addFlash('success', 'Supplier has been deleted!');
        return $this->redirectToRoute('app_supplier_all');
    }

    #[Route('/supplier/{id}', name: 'app_supplier_details')]
    public function detailsAction(SupplierRepository $supplierRepository, Supplier $supplier): Response
    {
//        dd($supplier);
        return $this->render('supplier/details.html.twig', [
            'supplier' => $supplier
        ]);
    }
}