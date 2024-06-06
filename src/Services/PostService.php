<?php 

namespace App\Services;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use App\Repository\BlogUserRepository;
use Doctrine\ORM\EntityManagerInterface;

class PostService {

    public function __construct(
        private BlogUserRepository $blogUserRepository,
        private BlogPostRepository $blogPostRepository,
        private EntityManagerInterface $em,
        private SanitizerService $sanitizer,) {
    }
    

    public function getAllPosts(): array
    {   
        $posts = $this->blogPostRepository->findAll();
        return $posts;
    }


    public function createPost(array $data): void
    {
        
        $title = $this->sanitizer->sanitize($data["title"]) ;
        $description = $this->sanitizer->sanitize($data["description"]) ;
        $picture = $this->sanitizer->sanitize($data["picture"]) ?: "" ;
        $date = date('Y-m-d');
        $user = $this->blogUserRepository->find($data["user"]);



        $newPost = new BlogPost();
        
        $newPost->setTitle($title);
        $newPost->setDescription($description);
        $newPost->setDate($date);
        $newPost->setPicture($picture);
        $newPost->setBlogUser($user);


        $this->em->persist($newPost);
        $this->em->flush();
    }
}

