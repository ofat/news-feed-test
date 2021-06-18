<?php

namespace App\Service\TranslateUrl\Strategies;

use App\Repository\PostRepository;
use App\Service\TranslateUrl\Abstracts\AbstractUrlTranslation;
use App\Service\TranslateUrl\Contracts\UrlTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostUrlTranslation extends AbstractUrlTranslation implements UrlTranslation
{

    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository, UrlGeneratorInterface $urlGenerator)
    {
        $this->repository = $repository;
        parent::__construct($urlGenerator);
    }

    public function isApplicable(): bool
    {
        return $this->routeInfo['_route'] == 'post';
    }

    public function getTranslatedUrl(string $locale): string
    {
        $oldLocale = $this->routeInfo['_locale'];
        $oldSlug = $this->routeInfo['slug'];
        $post = $this->repository->findByLocaleSlug($oldLocale, $oldSlug);

        return $this->urlGenerator->generate('post', [
            'slug' => $post->translate($locale)->getSlug(),
            '_locale' => $locale
        ]);
    }
}
