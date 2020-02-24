<?php

namespace RefugeBundle\Controller;

use RefugeBundle\Entity\camp;
use RefugeBundle\Entity\refuge;
use RefugeBundle\Form\campType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class campController extends Controller
{
    public function ajoutCampAction(Request $request)
    {
        $camp = new camp();
       // $refugie = new refuge();
        $form = $this->createForm(campType::class, $camp);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($camp);
            $em->flush();
            return $this->redirectToRoute("refugee_ajoutCamp");

        }
        $camp = $em->getRepository("RefugeBundle:camp")->findAll();
        $refugie = $em->getRepository("RefugeBundle:Refuge")->findAll();



        return $this->render("@Refuge/Refuge/ajoutC.html.twig", array('form' => $form->createView(), 'camp' => $camp, 'refugee' => $refugie));
    }

    public function afficherCampAction()
    {
        $em = $this->getDoctrine()->getManager();
        $camp = $em->getRepository("RefugeBundle:camp")->findAll();
        return $this->render("@Refuge/Refuge/ajoutC.html.twig", array('camp' => $camp));
    }

    public function  modifierCAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $camp = $em->getRepository("RefugeBundle:camp")->find($id);
        $form = $this->createForm(campType::class, $camp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($camp);
            $em->flush();
            return $this->redirectToRoute("refugee_ajoutCamp");
        }
        return $this->render("@Refuge/Refuge/ajoutC1.html.twig", array('update' => $form->createView()));
    }

    public function supprimerCAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $camp = $em->getRepository("RefugeBundle:camp")->find($id);
        if ($camp == null) return -1;
        else
        {
            $em->remove($camp);
            $em->flush();
            return $this->redirectToRoute("refugee_ajoutCamp");
        }
    }


}

