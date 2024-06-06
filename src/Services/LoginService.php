<?php 

namespace App\Services;

use App\Entity\BlogUser;
use App\Repository\BlogUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginService {

    public function __construct(
        private BlogUserRepository $blogUserRepository, 
        private EntityManagerInterface $em , 
        private UserPasswordHasherInterface $passwordAuth, 
        private readonly ManagerRegistry $managerRegistry
) {}

    function handleLogin(string $password, string $email) :?object {
        
        $user = $this->managerRegistry->getRepository(BlogUser::class)->findOneBy(["email" => $email]);
        
        if ($user && $this->passwordAuth->isPasswordValid($user, $password)) {
            return $user;
        }
        
        return null;


    }

}