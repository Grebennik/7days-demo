<?php

namespace Domain\Post;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use joshtronic\LoremIpsum;

class PostManager
{
    private EntityManagerInterface $em;
    private LoremIpsum $loremIpsum;

    public function __construct(EntityManagerInterface $em, LoremIpsum $loremIpsum)
    {
        $this->em = $em;
        $this->loremIpsum = $loremIpsum;
    }

    public function addPost($title, $content)
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setContent($content);
        $this->em->persist($post);
        $this->em->flush();
    }

    public function findPost($id): Post
    {
        $postRepository = $this->em->getRepository(Post::class);

        return $postRepository->findOneBy(['id' => $id]);
    }

    public function generateRandomPost()
    {
        $content = $this->loremIpsum->paragraphs();

        $post = new Post();
        $post->setTitle('Summary ' . date('Y-m-d'));
        $post->setContent($content);

        $this->em->persist($post);
        $this->em->flush();
    }
}
