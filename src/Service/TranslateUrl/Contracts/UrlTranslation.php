<?php

namespace App\Service\TranslateUrl\Contracts;

/**
 * Interface EntityTranslation
 * @package App\Service\TranslateUrl\Contracts
 */
interface UrlTranslation
{

    /**
     * @return bool
     */
    public function isApplicable(): bool;

    /**
     * @param string $locale
     * @return string
     */
    public function getTranslatedUrl(string $locale): string;
}