<?php

namespace UserFlowBundle\Twig;
use Doctrine\ORM\EntityManager;

class WorkflowExtension extends \Twig_Extension
{
    private $em;
    private $user;

    public function __construct(EntityManager $em, $securityContext)
    {
        $this->em=$em;
        $token = $securityContext->getToken();
        if($token){
            $this->user=$token->getUser();
        }else{
            $user=null;
        }
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('user_flow_login_message_state', [$this, 'getState']),
            new \Twig_SimpleFunction('user_flow_login_message_hide_state', [$this, 'setStateHide']),
        );
    }
    
    public function getState(){
        if($this->user){
            $repository = $this->em->getRepository('UserFlowBundle:LoginMessage');
            return $repository->getUserState($this->user);
        }else{
            return 'Could not resolve user';
            
        }
    }
    
    public function setStateHide(){
        if($this->user){
            $repository = $this->em->getRepository('UserFlowBundle:LoginMessage');
            return $repository->setUserState($this->user, 'hide');            
        }
    }

    // This method is a hack to get all transitions, enable-able or not.
    // This should be done only for a demo purpose
//    public function getTransitions($object, $name = null)
//    {
//        $workflow = $this->workflowRegistry->get($object, $name);
//
//        return $workflow->getDefinition()->getTransitions();
//    }
//
//    public function getName()
//    {
//        return 'workflow_developer';
//    }
}
