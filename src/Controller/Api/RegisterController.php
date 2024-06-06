<?php

namespace App\Controller\Api;

use App\Services\RegisterService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/api/register', name: 'app_api_register', methods:['POST'])]
    public function handleRegister(Request $request, RegisterService $registerService): Response
    {

        try {
            
            $data = json_decode($request->getContent(), true);
            $result = $registerService->handleRegister($data);
            return $this->json(['message' => 'Inscription successfull', "status" => "success"], Response::HTTP_OK);

        } catch (Exception $e) {

            return $this->json(['status'=>'error', "message" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
            
        }    

    }
}
