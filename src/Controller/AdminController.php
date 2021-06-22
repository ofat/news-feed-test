<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostTranslation;
use App\Form\PostType;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 *
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(PostRepository $repository): Response
    {
        return $this->render('admin/index.html.twig', [
            'posts' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/admin/post/{id}", name="edit_post")
     * @param Post $post
     * @return Response
     */
    public function editPost(Post $post, Request $request): Response
    {
        $this->denyAccessUnlessGranted('edit', $post);

        return $this->postFormProcessing($post, $request);
    }

    /**
     * @Route("/admin/post", name="create_post")
     * @return Response
     */
    public function createPost(Request $request): Response
    {
        $post = new Post();
        $translationEn = new PostTranslation();
        $translationEn->setLocale('en');

        $translationFr = new PostTranslation();
        $translationFr->setLocale('fr');

        $post->addTranslation($translationEn);
        $post->addTranslation($translationFr);

        return $this->postFormProcessing($post, $request);
    }

    protected function postFormProcessing(Post $post, Request $request)
    {
        $form = $this->createForm(PostType::class, $post, [
            'require_image' => is_null($post->getId())
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setAuthor($this->getUser());

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/images/posts/';
                $newFilename = $post->translate()->getSlug().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $post->setImage($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/form.html.twig', [
            'form' => $form->createView(),
            'post' => $post
        ]);
    }
}
