<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;


class PostsController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('home', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale}", name="posts")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('posts/index.html.twig', [
            'posts' => $postRepository->findAll()
        ]);
    }

    /**
     * @Route("/{_locale}/posts/{slug}", name="post")
     * @Entity("post", expr="repository.findByLocaleSlug(_locale, slug)")
     */
    public function show(Post $post)
    {
        return $this->render('posts/view.html.twig', [
            'post' => $post
        ]);
    }
}
