<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\PriceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/price", name="price_")
 */
class PriceController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        $prices = $this->getDoctrine()
            ->getRepository(Price::class)
            ->findAll();

        return $this->render('price/index.html.twig', ['prices' => $prices]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($price);
            $em->flush();

            return $this->redirectToRoute('price_edit', ['id' => $price->getId()]);
        }

        return $this->render('price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Price $price)
    {
        return $this->render('price/show.html.twig', [
            'price' => $price,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Price $price)
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('price_edit', ['id' => $price->getId()]);
        }

        return $this->render('price/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Price $price)
    {
        if (!$this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('price_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($price);
        $em->flush();

        return $this->redirectToRoute('price_index');
    }
}
