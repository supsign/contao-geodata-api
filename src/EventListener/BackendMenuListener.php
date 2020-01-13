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

        $contentNode = $tree->getChild('accounts');

        $node = $factory->createItem(
            'my-modules',
            [
                'label' => 'Präsenzliste',
                'attributes' => [
                    'title' => 'Erstellen Sie die Präsenzliste.',
                    'href' => 'https://supsign.ch',
                    // 'href' => $this->router->generate('app.backend-route'),
                    'class' => 'my-modules'
                ],
            ]
        );

        $node->setCurrent($this->requestStack->getCurrentRequest()->get('_backend_module') === 'my-modules');       //  highlights the menu icon if we are on route of our plugin

        $contentNode->addChild($node);
    }
}