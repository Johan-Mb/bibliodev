<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Themes::class)]
    private $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Themes[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Themes $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->setUser($this);
        }

        return $this;
    }

    public function removeTheme(Themes $theme): self
    {
        if ($this->themes->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getUser() === $this) {
                $theme->setUser(null);
            }
        }

        return $this;
    }
}
