<?php

namespace CoreBundle\Controller;

use CoreBundle\Form\contactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class CoreController extends Controller
{
  /**
   * @Route("/", name="home")
   * @Method("GET")
   * @Template()
   */
    public function indexAction()
    {

        return $this->render('CoreBundle:Core:index.html.twig');
    }

  /**
   * @Route("/resume", name="resume")
   * @Method("GET")
   * @Template()
   */
    public function resumeAction()
    {

        return $this->render('CoreBundle:Core:resume.html.twig');
    }

    /**
     * @Route("/gallery", name="gallery")
     * @Method("GET")
     * @Template()
     */
    public function galleryAction()
    {

      return $this->render('CoreBundle:Core:gallery.html.twig');
    }

  /**
   * @Route("/contact", name="contact")
   * @Method("GET|POST")
   * @Template()
   */
  public function contactAction(Request $request)
  {
    $form = $this->get('form.factory')->create(contactType::class);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $post = $request->request->get('corebundle_contact');

      $message = \Swift_Message::newInstance()
        ->setSubject('Nouvel e-mail envoyé depuis le portfolio')
        ->setFrom($post['email'])
        ->setTo('yterrana@hotmail.fr')
        ->setBody(
          $this->renderView(
            'Emails/contact.html.twig',
            array(
              'fullname' => $post['fullname'],
              'message' => $post['message'],
              'email' => $post['email']
            )
          ),
          'text/html'
        );
      $this->get('mailer')->send($message);
      $this->addFlash('success', 'sended');

      return $this->redirectToRoute('contact');
    }

    return array(
      'form' => $form->createView(),
    );
  }
}