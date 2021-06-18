<?php

namespace App\Controller;

use App\Service\TranslateUrl\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    /**
     * @Route("/language-set/{locale}", name="language")
     */
    public function languageSet(string $locale, Manager $translateUrl): Response
    {
        return $this->redirect( $translateUrl->getTranslatedPreviousUrl($locale) );
    }
}
