<?php

namespace App\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TranslateUrlCompilerPass
 * @package App\DependencyInjection\CompilerPass
 */
class TranslateUrlCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container): void
    {
        $context = $container->findDefinition('translate_url.context');
        $taggedServices = $container->findTaggedServiceIds('translate_url.strategy');
        $taggedServiceIds = array_keys($taggedServices);
        foreach ($taggedServiceIds as $taggedServiceId)
        {
            $context->addMethodCall('addStrategy', [new Reference($taggedServiceId)]);
        }
    }

}