<?php

namespace App\Service\TranslateUrl;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class TranslateUrl
 * @package App\Service
 */
class Manager
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var array
     */
    protected $routeInfo;

    protected $container;

    public function __construct(RequestStack $requestStack, RouterInterface $router, ContainerInterface $container)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->router = $router;
        $this->container = $container;
    }

    /**
     * Get information about previous url
     */
    protected function discoverPreviousUrl(): void
    {
        $oldUrl = parse_url($this->request->headers->get('referer'));
        if(isset($oldUrl['path']))
        {
            $this->routeInfo = $this->router->match($oldUrl['path']);
        }
    }

    /**
     * @param string $locale
     * @return string
     * @throws \Exception
     */
    public function getTranslatedPreviousUrl(string $locale): string
    {
        $this->discoverPreviousUrl();

        /**
         * no information about previous route
         */
        if(!isset($this->routeInfo['_route']))
        {
            return '/'.$locale;
        }

        $context = $this->container->get('translate_url.context');
        return $context->translateUrl($this->routeInfo, $locale);
    }

}