<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_posts_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['api_posts_get'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_posts_get'])]
    private ?string $description = null;

    #[ORM\Column(length: 1000, nullable: true)]
    #[Groups(['api_posts_get'])]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_posts_get'])]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'blogPosts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['api_posts_get'])]
    private ?BlogUser $BlogUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getBlogUser(): BlogUser|int
    {
        return $this->BlogUser;
    }

    public function setBlogUser(BlogUser|int $BlogUser): static
    {
        $this->BlogUser = $BlogUser;

        return $this;
    }
}
