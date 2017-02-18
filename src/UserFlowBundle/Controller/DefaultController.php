<?php

namespace UserFlowBundle\Controller;
use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/userflow")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('UserFlowBundle:Default:index.html.twig', ['user'=>$user]);
    }
    
    /**
     * @Route("/apply-transition/", name="user_flow_apply_transition")
     * @Method("POST")
     */
    public function applyTransitionAction(Request $request)
    {
        try {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em = $this->get('doctrine')->getManager();
            $repository = $em->getRepository('UserFlowBundle:LoginMessage');
            $loginMessage = $repository->findOneOrCreateByUser($user);
            $service = $this->get('state_machine.loginModal');
            #service->apply($loginMessage, 'message_shown');
            $service->apply($loginMessage, $request->request->get('transition'));

            $this->get('doctrine')->getManager()->flush();
        } catch (ExceptionInterface $e) {
            $this->get('session')->getFlashBag()->add('danger', $e->getMessage());
        }

        return $this->redirect(
            $this->generateUrl('task_show', ['id' => 1])
        );
    }
    
}
