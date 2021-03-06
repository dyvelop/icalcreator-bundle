<?php

namespace Dyvelop\ICalCreatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DyvelopICalCreatorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('dyvelop_icalcreator.default_timezone', $config['default_timezone']);
        $container->setParameter('dyvelop_icalcreator.default_unique_id', $config['default_unique_id']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }


    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return 'dyvelop_icalcreator';
    }
}
