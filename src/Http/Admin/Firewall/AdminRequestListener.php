<?php

namespace App\Http\Admin\Firewall;


use App\Controller\Admin\BaseController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManager;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminRequestListener implements EventSubscriberInterface  {


    private AuthorizationCheckerInterface $auth;
    private string $adminPrefix;


    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onController',
            RequestEvent::class => 'onRequest'
        ];
    }

    public function __construct(string $adminPrefix, AuthorizationCheckerInterface $auth)
    {
        $this->adminPrefix = $adminPrefix;
        $this->auth = $auth;
    }

    public function onRequest(RequestEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $uri = "/" . trim($event->getRequest()->getRequestUri(), "/") . '/';
        $prefix = "/" . trim($this->adminPrefix, '/') . '/';
        if (substr($uri, 0, mb_strlen($prefix)) === $prefix && !$this->auth->isGranted('ROLE_ADMIN'))
        {
            $exception = new AccessDeniedException();
            $exception->setSubject($event->getRequest());
            throw $exception;
        }


    }
    public function onController(ControllerEvent $event):void{
        if (false === $event->isMasterRequest()) {
            return;
        }
        $controller = $event->getController();
        if (is_array($controller) && $controller[0] instanceof BaseController && !$this->auth->isGranted('ROLE_ADMIN')) {
            $exception = new AccessDeniedException();
            $exception->setSubject($event->getRequest());
            throw $exception;
        }
    }

}
