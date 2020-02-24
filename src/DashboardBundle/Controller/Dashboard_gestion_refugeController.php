<?php

namespace DashboardBundle\Controller;

use AppBundle\Entity\User;
use RefugeBundle\Entity\Refuge;
use RefugeBundle\Form\RefugeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Dashboard_gestion_refugeController extends Controller
{
    public function read_refugeAction()
    {
        $refuge=$this->getDoctrine()->getRepository(Refuge::class)->findAll();
        return $this->render('@Dashboard/refuge/refuge_read.html.twig',array('refuge'=>$refuge));
    }


    public function deleteRefAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $refuge=$em->getRepository(Refuge::class)->find($id);
        $em->remove($refuge);
        $em->flush();

        return $this->redirectToRoute('dashboard_gestion_refuge_page');
    }

    public function modifRefAction(Request $request,$id)
    {
        $refuge =new Refuge();
        $em=$this->getDoctrine()->getManager();
        $refuge=$em->getRepository("RefugeBundle:Refuge")->find($id);

        $form=$this->createForm(RefugeType::class,$refuge) ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();

            return $this->redirectToRoute('dashboard_gestion_refuge_page');

        }
        return $this->render('@Refuge/Refuge/modifRef.html.twig',array('form'=>$form->createView()));
    }

    public function ajoutRefAction(Request $request)
    {
        $refuge=new Refuge();
        $form=$this->createForm(RefugeType::class,$refuge);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($refuge);
            $em->flush();
            return $this->redirectToRoute('dashboard_gestion_refuge_page');
        }
        return $this->render('@Refuge/Refuge/addRef.html.twig',array("form"=>$form->createView()));
    }


}
