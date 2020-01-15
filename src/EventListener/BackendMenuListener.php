<?php

namespace Supsign\ContaoAttendanceListBundle\EventListener;

use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function onBuild(MenuEvent $event): void
    {
        $factory = $event->getFactory();
        $tree = $event->getTree();

        $mainMenu = $factory
            ->createItem('supsign')
            ->setUri('/contao')
            ->setLabel('MSC.supisgn')
            ->setLinkAttribute('class', 'group-system')
            ->setLinkAttribute('onclick', "return AjaxRequest.toggleNavigation(this, 'supsign', '/contao')")
            ->setChildrenAttribute('id', 'supsign')
            ->setExtra('translation_domain', 'contao_default');

        $subMenu = $tree->addChild($mainMenu);

        $list = $factory
            ->createItem('attendance-list')
            ->setUri('/contao/attendancelist')
            ->setLabel('MSC.attendancelist')
            ->setCurrent($this->requestStack->getCurrentRequest()->get('_backend_module') === 'attendance-list')
            ->setExtra('translation_domain', 'contao_default');

        $subMenu->addChild($list);

        // var_dump($mainMenu);
        // die();
    }
}
