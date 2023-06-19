<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Form\CartDetailType;
use App\Repository\CartDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartDetailController extends AbstractController
{
    #[Route('/cart_detail', name: 'app_cart_detail')]
    public function index(): Response
    {
        return $this->render('cart_detail/index.html.twig', [
            'controller_name' => 'CartDetailController',
        ]);
    }
    #[Route('/cart_detail/all', name: 'app_cart_detail_all')]
    public function get_cartDetail(CartDetailRepository $cartDetailRepository): Response
    {
        $cartDetails = $cartDetailRepository->findAll();
        //dd($cartDetail);
        return $this->render('cart_detail/index.html.twig',
            ['cartDetails' => $cartDetails]);
    }
    #[Route('/cart_detail/create', name: 'app_cart_detail_create', priority: 1)]
    public function createAction(CartDetailRepository $cartDetailRepository, Request $request): Response
    {

        $form = $this->createForm(CartDetailType::class, new  CartDetail());

//        dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartDetail = $form->getData();
            $cartDetailRepository->save($cartDetail, true);
            $this->addFlash('success', 'cartDetail\'s inserted successfully');
            return $this->redirectToRoute('app_cart_detail_all');
        }

        return $this->render('cart_detail/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/cart_detail/{id}', name: 'app_cart_detail_details')]
    public function detailsAction(CartDetail $cartDetail): Response
    {
        return $this->render('cart_detail/details.html.twig', [
            'cartDetail' => $cartDetail
        ]);
    }
}
