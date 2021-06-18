<?php

namespace App\Service\TranslateUrl\Strategies;

use App\Service\TranslateUrl\Abstracts\AbstractUrlTranslation;
use App\Service\TranslateUrl\Contracts\UrlTranslation;

/**
 * Class BasicRouteUrlTranslation
 * @package App\Service\TranslateUrl\Strategies
 */
class BasicRouteUrlTranslation extends AbstractUrlTranslation implements UrlTranslation
{

    /**
     * Basic route is applicable when there is no extra parameters to route. So there is only 3 items in $routeInfo
     * @return bool
     */
    public function isApplicable(): bool
    {
        return count($this->routeInfo) == 3;
    }

    /**
     * @param string $locale
     * @return string
     */
    public function getTranslatedUrl(string $locale): string
    {
        return $this->urlGenerator->generate($this->routeInfo['_route'], ['_locale' => $locale]);
    }
}