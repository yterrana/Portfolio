<?php

namespace TchatBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/tchat")
 */
class TchatController extends Controller
{

  /**
   * @Route("/", name="tchat")
   * @Method("GET")
   * @Template()
   */
  public function tchatAction()
  {
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('UserBundle:user')->findAll();

    return array(
      'users' => $user,
    );
  }


}
