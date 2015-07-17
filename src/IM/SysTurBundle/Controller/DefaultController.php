<?php

namespace IM\SysTurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IMSysTurBundle:Default:main.html.twig');
    }
    
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

/*        // Leemos los parámetros del sistema
        $em = $this->getDoctrine()->getManager();
        $parameters = $em->getRepository('IMManTorneosBundle:TorParameters')->find('1');
        if (!$parameters)
        {
                throw $this->createNotFoundException('No es posible leer los par&aacute;metros del sistema.');
        }
 
 */
        $parameters = null;

         // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('IMSysTurBundle:Default:login.html.twig', array('last_username' => $session->get(SecurityContext::LAST_USERNAME), 'error'=> $error, 'parameters'=>$parameters));
    }
}
