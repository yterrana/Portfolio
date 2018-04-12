<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

/**
 * @Route("/profile")
 */
class UserController extends Controller
{
  /**
   * @Route("/", name="profile")
   * @Method("GET|POST")
   * @Template()
   */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('UserBundle:user')->findAll();

        return array(
          'user' => $profile,
        );
    }
}
