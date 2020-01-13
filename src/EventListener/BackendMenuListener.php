<?php

namespace App\EventListener;

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

        $contentNode = $tree->getChild('content');

        $node = $factory->createItem(
            'attendance-list',
            [
                'label' => 'Präzenzliste',
                'attributes' => [
                    'title' => 'Title Test',
                    'href' => $this->router->generate('app.backend-route'),
                    'class' => 'attendance-list'
                ],
            ]
        );

        $node->setCurrent($this->requestStack->getCurrentRequest()->get('_backend_module') === 'attendance-list');

        $contentNode->addChild($node);
    }
}