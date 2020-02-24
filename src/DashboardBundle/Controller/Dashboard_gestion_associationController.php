<?php

namespace DashboardBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Dashboard_gestion_associationController extends Controller
{

    public function read_associationAction()
    {
        $association=$this->getDoctrine()->getRepository(User::class)->findBy(array('association' => 'true'));
        return $this->render('@Dashboard/Gestion_association/gestion_association_read.html.twig',array('association'=>$association));
    }

    public function delete_associationAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $association=$em->getRepository(User::class)->find($id);
        $em->remove($association);
        $em->flush();
        return $this->redirectToRoute('dashboard_gestion_association_page');
    }

}
