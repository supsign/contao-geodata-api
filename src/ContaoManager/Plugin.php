<?php

namespace Supsign\ContaoAttendanceListBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Supsign\ContaoAttendanceListBundle\ContaoAttendanceListBundle;

class Plugin implements BundlePluginInterface
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
}
