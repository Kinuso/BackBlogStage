<?php

namespace App\Controller\Api;

use App\Entity\BlogPost;
use App\Repository\BlogUserRepository;
use App\Services\PostService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/post/', name: 'app_api_post_')]
class PostController extends AbstractController
{


    public function __construct(private PostService $postService) {
    }


    #[Route('getAllPosts', name: 'getAllPosts', methods:["GET"])]
    public function getAllPosts(): Response
    {

        try {

            $result = $this->postService->getAllPosts();
            return $this->json(['posts' => $result], Response::HTTP_OK, context:['groups' => ["api_posts_get"]]);

        } catch (Exception $e) {

            return $this->json(['status'=>'error', "message" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
            
        }
    }



    #[Route('newPost', name: 'newPost', methods: ["POST"])]
    public function newPost(Request $request): JsonResponse
    {
        
        try {

            $data = json_decode($request->getContent(), true);
            $this->postService->createPost($data);
            return $this->json(["message" => "Post created"], Response::HTTP_OK);

        } catch (Exception $e) {

            return $this->json(['status'=>'error', "message" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
            
        }
    }
}

