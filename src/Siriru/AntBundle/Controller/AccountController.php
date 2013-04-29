<?php

namespace Siriru\AntBundle\Controller;

use Siriru\AntBundle\Form\Model\Registration;
use Siriru\AntBundle\Form\Type\RegistrationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class AccountController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/account/register", name="account_register")
     * @Template()
     */
    public function registerAction()
    {
        $form = $this->createForm(new RegistrationType(), new Registration());
    
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/account/create", name="account_create")
     * @Template()
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
    
        $form = $this->createForm(new RegistrationType(), new Registration());
    
        $form->bind($this->getRequest());
    
        if ($form->isValid()) {
            $registration = $form->getData();
            $user = $registration->getUser();

            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();
    
            return $this->redirect($this->generateUrl('homepage'));
        }
    
        return $this->render('SiriruAntBundle:Account:register.html.twig', array('form' => $form->createView()));
    }
}