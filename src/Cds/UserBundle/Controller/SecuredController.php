<?php

namespace Cds\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cds\UserBundle\Entity\User;

/**
 * Description of SecuredController
 *
 * @author clamz
 */

/**
 * @extra:Route("/user")
 */
class SecuredController extends Controller {
    
    /**
     * @extra:Route("/login", name="_demo_login")
     * @extra:Template()
     */
    public function loginAction(){
       $userManager = $this->container->get('user_manager');
       $user = $userManager->findUserBy(array('username' => 'clamz'));

        return array(
            'last_username' => $user,
            'error'         => "ff",
        );
        
        
    }
    
    
    
    /**
     * @extra:Route("/add_user", name="_add_user")
     * @extra:Template()
     */
    
    public function createAction()
    {
        $user = new User();
        $user->setUsername('clamz');

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($user);
        $em->flush();

        return array('error' => "no error");
    }    
    
}

