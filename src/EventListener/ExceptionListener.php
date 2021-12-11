<?php
namespace App\EventListener;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ExceptionListener{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $controller = explode('/',$event->getRequest()->getRequestUri());
        $controller = sizeof($controller) > 1 ? $controller[1] : null;
        $project = $this->em->getRepository(Project::class)->findOneBy([]);
        if(!$project){
            $event->setResponse(new RedirectResponse('/project/create'));
        } else if($controller == 'status'){}
        else{
            $event->setResponse(new RedirectResponse('/status/' . $project->getId()));
        }
    }
}