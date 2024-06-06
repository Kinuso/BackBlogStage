<?php

namespace App\Entity;

use App\Repository\BlogRoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRoleRepository::class)]
class BlogRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, BlogUser>
     */
    #[ORM\OneToMany(targetEntity: BlogUser::class, mappedBy: 'BlogRole')]
    private Collection $blogUsers;

    public function __construct()
    {
        $this->blogUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, BlogUser>
     */
    public function getBlogUsers(): Collection
    {
        return $this->blogUsers;
    }

    public function addBlogUser(BlogUser $blogUser): static
    {
        if (!$this->blogUsers->contains($blogUser)) {
            $this->blogUsers->add($blogUser);
            $blogUser->setBlogRole($this);
        }

        return $this;
    }

    public function removeBlogUser(BlogUser $blogUser): static
    {
        if ($this->blogUsers->removeElement($blogUser)) {
            // set the owning side to null (unless already changed)
            if ($blogUser->getBlogRole() === $this) {
                $blogUser->setBlogRole(null);
            }
        }

        return $this;
    }
}
