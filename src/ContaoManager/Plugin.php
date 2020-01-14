<?php

namespace Supsign\ContaoAttendanceListBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Supsign\ContaoAttendanceListBundle\ContaoAttendanceListBundle;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoAttendanceListBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }

    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {

        $file = '@SupsignContaoAttendanceListBundle/Resources/config/routing.yml';
        return $resolver->resolve($file)->load($file);

        //  return $resolver
        //      ->resolve(__DIR__ . '/../Resources/config/routing.yml')
        //      ->load(__DIR__ . '/../Resources/config/routing.yml');
    }
}
