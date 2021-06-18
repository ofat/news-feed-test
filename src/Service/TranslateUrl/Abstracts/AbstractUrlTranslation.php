<?php

namespace App\Service\TranslateUrl\Abstracts;

use App\Service\TranslateUrl\Contracts\UrlTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AbstractEntityUrlTranslation
 * @package App\Service\TranslateUrl\Abstracts
 */
abstract class AbstractUrlTranslation implements UrlTranslation
{
    /**
     * @var array
     */
    protected $routeInfo;

    protected $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    abstract public function getTranslatedUrl(string $locale): string;

    /**
     * @param array $routeInfo
     * @return AbstractUrlTranslation
     */
    public function setRouteInfo(array $routeInfo): AbstractUrlTranslation
    {
        $this->routeInfo = $routeInfo;
        return $this;
    }
}