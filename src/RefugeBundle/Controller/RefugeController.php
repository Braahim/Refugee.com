<?php

namespace RefugeBundle\Controller;

use RefugeBundle\Entity\camp;
use RefugeBundle\Entity\Refuge;
use RefugeBundle\Form\RefugeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RefugeController extends Controller
{


    public function read_refugeAction()
    {
        $refuge=$this->getDoctrine()->getRepository(Refuge::class)->findAll();
        return $this->render('@Refuge/refuge/refuge_read.html.twig',array('refuge'=>$refuge));
    }

    public function ajoutRefugieAction(Request $request)
    {
        $refugie = new Refuge();
        $form = $this->createForm(RefugeType::class, $refugie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             *
             */
            $file=$refugie->getImg();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName
            );
            $refugie->setImg($fileName);
            $em = $this->getDoctrine()->getManager();
            $this->getDoctrine()->getRepository("RefugeBundle:camp")->updateCapacityMinus($refugie->getCamp());

            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute("volunteer_association_profile");
        }

        return $this->render("@volunteer/Association/ajoutR.html.twig", array('form' => $form->createView()));
    }

    public function afficherRefugeeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $refugee = $em->getRepository("RefugeBundle:refuge")->findAll();
        return $this->render("@volunteer/Association/Association_profile.html.twig", array('refugee' => $refugee));
    }

    public function  modifierRefugieAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $refugie = $em->getRepository(Refuge::class)->find($id);
        $form = $this->createForm(RefugeType::class, $refugie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute("volunteer_association_profile");
        }
        return $this->render("@Refuge/refuge/modifierR.html.twig", array('form' => $form->createView()));
    }

    public function supprimerRefugieAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $refugie = $em->getRepository(Refuge::class)->find($id);
        if ($refugie == null) return -1;
        else
        {
            $this->getDoctrine()->getRepository(camp::class)->updateCapacityPlus($refugie->getCamp());
            $em->remove($refugie);
            $em->flush();
            return $this->redirectToRoute("volunteer_association_profile");
        }
    }

    public function afficherDetailleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $refugee = $em->getRepository("RefugeBundle:Refuge")->find($id);

        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('no-outline', true);
        $snappy->setOption('page-size','LETTER');
        $snappy->setOption('encoding', 'UTF-8');
        $snappy->setOption('images' , true);

        $html= $this->renderView("@volunteer/Association/ficheR.html.twig", array('refugee' => $refugee));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );



    }
}
