<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(PasswordHasherFactoryInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@test.com');
        $admin->setName('Mike');
        $admin->setPassword($this->passwordHasher->getPasswordHasher(User::class)->hash('adminpass'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $admin2 = new User();
        $admin2->setEmail('admin2@test.com');
        $admin2->setName('John');
        $admin2->setPassword($this->passwordHasher->getPasswordHasher(User::class)->hash('adminpass'));
        $admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $post1 = new Post();
        $post1->setPublishedAt(new \DateTime());
        $post1->setStatus(Post::STATUS_PUBLISHED);
        $post1->setAuthor($admin);
        $post1->setImage('yellow-flowers.jpeg');

        $post1->translate('en')->setName('Yellow flowers');
        $post1->translate('en')->setDescription('Yellow flowers short description very interesting post');
        $post1->translate('en')->setContent('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis imperdiet leo, vitae vehicula purus. Proin quis libero ultricies, ornare est eget, maximus metus. Maecenas eleifend lacus lacinia felis pharetra auctor. Nam porttitor rhoncus dictum. Mauris mattis fermentum massa, et vestibulum magna suscipit vel. Duis gravida mauris vel eros fermentum, quis luctus turpis sodales. Curabitur molestie auctor enim quis gravida.</p><p>Vivamus molestie sollicitudin lacinia. Curabitur varius varius lacus ut eleifend. Integer semper turpis vitae sem auctor sagittis. Integer diam lectus, dignissim id nibh sit amet, pulvinar fermentum ante. Sed lacinia rutrum felis, vitae gravida eros lacinia quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus sed facilisis felis.</p>');

        $post1->translate('fr')->setName('Fleurs jaunes');
        $post1->translate('fr')->setDescription('Fleurs jaunes brève description article très intéressant');
        $post1->translate('fr')->setContent('<p>Praesent non nisi enim. Ut eros nulla, aliquam vitae felis eu, vestibulum ultrices ante. Nulla interdum mi non erat congue, ut maximus odio commodo. Sed aliquam nisl a ligula euismod varius. Vestibulum vitae magna sed arcu consectetur tempor eget ac est.</p><p>Pellentesque ultricies molestie tincidunt. Nulla facilisi. Nam augue lacus, blandit non laoreet ac, suscipit eget lacus. Suspendisse consequat leo purus, maximus ullamcorper metus pretium et. Maecenas ornare est a sodales elementum. Nunc interdum egestas justo, id auctor quam sollicitudin in.</p>');

        $manager->persist($post1);
        $post1->mergeNewTranslations();

        $post2 = new Post();
        $post2->setPublishedAt(new \DateTime());
        $post2->setStatus(Post::STATUS_PUBLISHED);
        $post2->setAuthor($admin);
        $post2->setImage('green-tree.jpeg');

        $post2->translate('en')->setName('Green tree');
        $post2->translate('en')->setDescription('Green tree short description very interesting post');
        $post2->translate('en')->setContent('<p>This is green tree! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis imperdiet leo, vitae vehicula purus. Proin quis libero ultricies, ornare est eget, maximus metus. Maecenas eleifend lacus lacinia felis pharetra auctor. Nam porttitor rhoncus dictum. Mauris mattis fermentum massa, et vestibulum magna suscipit vel. Duis gravida mauris vel eros fermentum, quis luctus turpis sodales. Curabitur molestie auctor enim quis gravida.</p><p>Vivamus molestie sollicitudin lacinia. Curabitur varius varius lacus ut eleifend. Integer semper turpis vitae sem auctor sagittis. Integer diam lectus, dignissim id nibh sit amet, pulvinar fermentum ante. Sed lacinia rutrum felis, vitae gravida eros lacinia quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus sed facilisis felis.</p>');

        $post2->translate('fr')->setName('Arbre vert');
        $post2->translate('fr')->setDescription('Arbre vert brève description article très intéressant');
        $post2->translate('fr')->setContent('<p>C\'est l\'arbre vert! Praesent non nisi enim. Ut eros nulla, aliquam vitae felis eu, vestibulum ultrices ante. Nulla interdum mi non erat congue, ut maximus odio commodo. Sed aliquam nisl a ligula euismod varius. Vestibulum vitae magna sed arcu consectetur tempor eget ac est.</p><p>Pellentesque ultricies molestie tincidunt. Nulla facilisi. Nam augue lacus, blandit non laoreet ac, suscipit eget lacus. Suspendisse consequat leo purus, maximus ullamcorper metus pretium et. Maecenas ornare est a sodales elementum. Nunc interdum egestas justo, id auctor quam sollicitudin in.</p>');

        $manager->persist($post2);
        $post2->mergeNewTranslations();

        $post3 = new Post();
        $post3->setPublishedAt(new \DateTime());
        $post3->setStatus(Post::STATUS_PUBLISHED);
        $post3->setAuthor($admin2);
        $post3->setImage('blue-water.jpeg');

        $post3->translate('en')->setName('Blue water');
        $post3->translate('en')->setDescription('Blue water description very interesting post');
        $post3->translate('en')->setContent('<p>This is blue water! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis imperdiet leo, vitae vehicula purus. Proin quis libero ultricies, ornare est eget, maximus metus. Maecenas eleifend lacus lacinia felis pharetra auctor. Nam porttitor rhoncus dictum. Mauris mattis fermentum massa, et vestibulum magna suscipit vel. Duis gravida mauris vel eros fermentum, quis luctus turpis sodales. Curabitur molestie auctor enim quis gravida.</p><p>Vivamus molestie sollicitudin lacinia. Curabitur varius varius lacus ut eleifend. Integer semper turpis vitae sem auctor sagittis. Integer diam lectus, dignissim id nibh sit amet, pulvinar fermentum ante. Sed lacinia rutrum felis, vitae gravida eros lacinia quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus sed facilisis felis.</p>');

        $post3->translate('fr')->setName('l\'eau bleue');
        $post3->translate('fr')->setDescription('l\'eau bleue brève description article très intéressant');
        $post3->translate('fr')->setContent('<p>C\'est l\'arbre vert! Praesent non nisi enim. Ut eros nulla, aliquam vitae felis eu, vestibulum ultrices ante. Nulla interdum mi non erat congue, ut maximus odio commodo. Sed aliquam nisl a ligula euismod varius. Vestibulum vitae magna sed arcu consectetur tempor eget ac est.</p><p>Pellentesque ultricies molestie tincidunt. Nulla facilisi. Nam augue lacus, blandit non laoreet ac, suscipit eget lacus. Suspendisse consequat leo purus, maximus ullamcorper metus pretium et. Maecenas ornare est a sodales elementum. Nunc interdum egestas justo, id auctor quam sollicitudin in.</p>');

        $manager->persist($post3);
        $post3->mergeNewTranslations();

        $comment = new Comment();
        $comment->setAuthor('Jack McGreen');
        $comment->setMessage('Very first comment');
        $comment->setPost($post1);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor('John');
        $comment->setMessage('Very interesting comment');
        $comment->setPost($post1);
        $manager->persist($comment);

        $comment2 = new Comment();
        $comment2->setAuthor('Bill Armstrong');
        $comment2->setMessage('Very nice comment also!');
        $comment2->setPost($post1);
        $comment2->setParent($comment);
        $manager->persist($comment2);

        $manager->flush();
    }
}
