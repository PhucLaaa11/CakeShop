<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/create', name: 'app_product_create', priority: 1)]
    public function createAction(ProductRepository $productRepository, Request $request): Response
    {

        $form = $this->createForm(ProductType::class, new  Product());
        //dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $productRepository->save($product, true);
            $this->addFlash('success', 'Product\'s inserted successfully');
            return $this->redirectToRoute('app_product_all');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/product/all', name: 'app_product_all')]
    public function getProduct(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        return $this->render('product/index.html.twig',
            ['products' => $products]);
    }
}
