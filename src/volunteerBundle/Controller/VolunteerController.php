<?php

namespace volunteerBundle\Controller;

use AppBundle\Form\RegistrationFormType;
use FOS\UserBundle\Model\User;
use RefugeBundle\Form\RefugeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use volunteerBundle\Entity\Member;
use volunteerBundle\Form\MemberType;
use volunteerBundle\volunteerBundle;

class VolunteerController extends Controller
{
    public function indexAction()
    {
        return $this->render('@volunteer/Default/index.html.twig');
    }

    public function volunteerAction()
    {
        return $this->render('@volunteer/Volunteer/volunteer.html.twig');
    }

    public function associationAction()
    {
        return $this->render('@volunteer/Association/Association_profile.html.twig');
    }

    public function read_memberAction()
    {
        $member=$this->getDoctrine()->getRepository(\AppBundle\Entity\User::class)->findBy(['sub_id' => $this->getUser()->getId()]);
        $em = $this->getDoctrine()->getManager();
        $refugee = $em->getRepository("RefugeBundle:Refuge")->findAll();
        return $this->render('@volunteer/Association/Association_profile.html.twig',array('member'=>$member , 'refugee'=>$refugee));
    }


    public function delete_memberAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $member=$em->getRepository(\AppBundle\Entity\User::class)->find($id);
        $em->remove($member);
        $em->flush();
        return $this->redirectToRoute('volunteer_association_profile');
    }

    public function add_memberAction(Request $request){
        $member=new Member();
        $form=$this->createForm(MemberType::class,$member);
        $form =$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();
            return $this->redirectToRoute('volunteer_association_profile');
        }
     //   return $this->render('@volunteer/Association/add_member.html.twig',array('form'=>$form->createView()));
        $url=$this->generateUrl('fos_user_registration_register_member');
        return $this->redirect($url);
    }


    function  update_memberAction(Request $request,$id){
        $member =new \AppBundle\Entity\User();
        $em=$this->getDoctrine()->getManager();
        $member=$em->getRepository(\AppBundle\Entity\User::class)->find($id);

        $Form=$this->createForm(RegistrationFormType::class,$member) ;
        $Form->handleRequest($request);

        $submittedToken = $request->request->get('token');

            if($Form->isSubmitted() && $Form->isValid()){
                $em->flush();
                return $this->redirectToRoute('volunteer_association_profile');

            }

        return $this->render('@volunteer/Association/update_member.html.twig',array('form'=>$Form->createView()));
    }

    //Refugee
    public function ajoutRefugieAction(Request $request)
    {
        $refugie = new refugie();
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


}
