<?php

namespace App\Services;

use App\Entity\BlogUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService {

    public function __construct(private SanitizerService $sanitizer, private EntityManagerInterface $em, private UserPasswordHasherInterface $userPasswordHasherInterface) {
    }

    function handleRegister(array $data  ) : void {
        
        $newUser = new BlogUser();

        $email = $this->sanitizer->sanitize($data["email"]) ;
        $lastname = $this->sanitizer->sanitize($data["lastname"]) ;
        $firstname = $this->sanitizer->sanitize($data["firstname"]) ;
        $password = $this->userPasswordHasherInterface->hashPassword($newUser ,$data["password"]);
        $phone = $this->sanitizer->sanitize($data["phone"]);
        $roles = ["ROLE_USER"];

        
        $newUser->setEmail($email);
        $newUser->setFirstname($firstname);
        $newUser->setLastname($lastname);
        $newUser->setPassword($password);
        $newUser->setPhone($phone);
        $newUser->setRoles($roles);


        $this->em->persist($newUser);
        $this->em->flush();
    }
}