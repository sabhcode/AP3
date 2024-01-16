<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2, options: ["fixed" => true])]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'module', targetEntity: Way::class)]
    private Collection $ways;

    #[ORM\ManyToOne(inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Building $building = null;

    public function __construct()
    {
        $this->ways = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): static
    {
        $this->building = $building;

        return $this;
    }

    /**
     * @return Collection<int, Way>
     */
    public function getWays(): Collection
    {
        return $this->ways;
    }

    public function addWay(Way $way): static
    {
        if (!$this->ways->contains($way)) {
            $this->ways->add($way);
            $way->setModule($this);
        }

        return $this;
    }

    public function removeWay(Way $way): static
    {
        if ($this->ways->removeElement($way)) {
            // set the owning side to null (unless already changed)
            if ($way->getModule() === $this) {
                $way->setModule(null);
            }
        }

        return $this;
    }
}