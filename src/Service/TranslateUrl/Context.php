<?php

namespace App\Service\TranslateUrl;

use App\Service\TranslateUrl\Contracts\UrlTranslation;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class Context
 * @package App\Service\TranslateUrl
 */
class Context
{
    /**
     * @var UrlTranslation[]
     */
    protected $strategies = [];

    public function addStrategy(UrlTranslation $entityUrlTranslation): void
    {
        $this->strategies[] = $entityUrlTranslation;
    }

    /**
     * @param array $routeInfo
     * @param $locale
     * @return string
     * @throws \Exception
     */
    public function translateUrl(array $routeInfo, $locale): string
    {
        foreach($this->strategies as $strategy)
        {
            $strategy->setRouteInfo($routeInfo);

            if($strategy->isApplicable())
            {
                return $strategy
                    ->getTranslatedUrl($locale);
            }
        }

        throw new \Exception('Undefined route for translation');
    }
}