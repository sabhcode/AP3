<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\SmallIntType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Way $way = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $code = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->shelves = new ArrayCollection();
    }

    public function getCode(): ?String
    {
        return $this->code;
    }

    public function setCode(?String $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getWay(): ?Way
    {
        return $this->way;
    }

    public function setWay(?Way $way): static
    {
        $this->way = $way;

        return $this;
    }

    /**
     * @return Collection<int, Shelf>
     */
    public function getShelves(): Collection
    {
        return $this->shelves;
    }

    public function addShelf(Shelf $shelf): static
    {
        if (!$this->shelves->contains($shelf)) {
            $this->shelves->add($shelf);
            $shelf->setSection($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): static
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getSection() === $this) {
                $shelf->setSection(null);
            }
        }

        return $this;
    }
}
