<?php

namespace Domain\Post;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use joshtronic\LoremIpsum;

class PostManager
{
    private PostRepository $postRepository;
    private LoremIpsum $loremIpsum;

    public function __construct(PostRepository $postRepository, LoremIpsum $loremIpsum)
    {
        $this->postRepository = $postRepository;
        $this->loremIpsum = $loremIpsum;
    }

    public function addPost($title, $content, $flush = true)
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setContent($content);
        $this->postRepository->add($post, $flush);
    }

    public function findPost($id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function generateRandomPost($flush = true)
    {
        $content = $this->loremIpsum->paragraphs();

        $post = new Post();
        $post->setTitle('Summary ' . date('Y-m-d'));
        $post->setContent($content);

        $this->postRepository->add($post, $flush);
    }
}
