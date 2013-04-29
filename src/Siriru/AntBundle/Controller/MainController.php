<?php

namespace Siriru\AntBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends Controller
{
    /**
     * @Route("/", name="root")
     */
    public function mainAction()
    {
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * @Route("/home", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
