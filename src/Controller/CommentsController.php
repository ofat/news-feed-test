<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommentsController extends AbstractController
{

    /**
     * @Route("/api/save-comment", methods={"POST"})
     */
    public function save(Request $request, ValidatorInterface $validator)
    {
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);
        $post = $postRepository->find($data['post_id']);

        $comment = new Comment();
        $comment->setAuthor($data['author']);
        $comment->setMessage($data['message']);
        $comment->setPost($post);

        $errors = $validator->validate($comment);

        if(count($errors) > 0)
            return new JsonResponse($errors, 400);

        $em->persist($comment);
        $em->flush();

        return new JsonResponse($comment);
    }

    /**
     * @Route("/api/comments/{id}", name="comments")
     */
    public function index(int $id): Response
    {
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findForPost($id);

        return new JsonResponse($comments);
    }
}
