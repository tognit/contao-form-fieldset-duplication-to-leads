<?php

namespace CliffParnitzky\FormFieldsetDuplicationToLeadsBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;


/**
 * Plugin for the Contao Manager.
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles( ParserInterface $parser )
    {
        return [
            BundleConfig::create( 'CliffParnitzky\FormFieldsetDuplicationToLeadsBundle\CliffParnitzkyFormFieldsetDuplicationToLeadsBundle' )
                ->setLoadAfter( ['Contao\CoreBundle\ContaoCoreBundle'] ),
        ];
    }
}