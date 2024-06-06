<?php

namespace App\Controller\Api;

use App\Services\LoginService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{

    #[Route('/api/login', name: 'app_api_login', methods:['POST'])]
    public function handleLogin(Request $request, LoginService $loginService): Response
    {

        try {
            $data = json_decode($request->getContent(), true);
            $result = $loginService->handleLogin($data['password'], $data['email'] );
            return $this->json(["status" => "success",'user' => $result], Response::HTTP_OK, context:['groups' => ["api_login_user"]]);

        } catch (Exception $e) {

            return $this->json(['status'=>'error', "message" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
            
        }
    }
}
