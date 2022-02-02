<?php

namespace App\Entity;

use App\Repository\ThemesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemesRepository::class)]
class Themes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'themes')]
    private $user;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Subthemes::class)]
    private $subthemes;

    public function __construct()
    {
        $this->subthemes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Subthemes[]
     */
    public function getSubthemes(): Collection
    {
        return $this->subthemes;
    }

    public function addSubtheme(Subthemes $subtheme): self
    {
        if (!$this->subthemes->contains($subtheme)) {
            $this->subthemes[] = $subtheme;
            $subtheme->setTheme($this);
        }

        return $this;
    }

    public function removeSubtheme(Subthemes $subtheme): self
    {
        if ($this->subthemes->removeElement($subtheme)) {
            // set the owning side to null (unless already changed)
            if ($subtheme->getTheme() === $this) {
                $subtheme->setTheme(null);
            }
        }

        return $this;
    }
}
