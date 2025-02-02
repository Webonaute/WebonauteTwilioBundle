<?php
declare(strict_types=1);
namespace Webonaute\TwilioBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * This file is part of the BlackfordTwilioBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Fridolin Koch <info@fridokoch.de>
 */
class WebonauteTwilioExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config')));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->getDefinition('twilio.client')
            ->addArgument($config['username'])
            ->addArgument($config['password'])
            ->addArgument($config['accountSid'])
            ->addArgument($config['region']);
    }
}
