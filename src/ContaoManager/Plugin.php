<?php

namespace Supsign\ContaoHelloWordBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Supsign\ContaoHelloWordBundle\ContaoHelloWordBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoHelloWordBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
