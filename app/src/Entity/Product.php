<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    private const NUMBER_REFERENCE_PRODUCT = 12;

    #[ORM\Id]
    #[ORM\Column(columnDefinition: "BIGINT(" . self::NUMBER_REFERENCE_PRODUCT . ") UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT")]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, scale: 2)]
    private ?float $unit_price = null;

    #[ORM\Column]
    private ?int $nb_sales = null;

    #[ORM\Column(unique: true)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Stock::class)]
    private Collection $stocks;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImg::class, orphanRemoval: true)]
    private Collection $productImgs;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
        $this->productImgs = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return str_pad($this->id, self::NUMBER_REFERENCE_PRODUCT, "0", STR_PAD_LEFT);
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unit_price;
    }

    public function setPrice(float $unit_price): static
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setProduct($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProduct() === $this) {
                $stock->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getNbSales(): ?int
    {
        return $this->nb_sales;
    }

    public function setNbSales(int $nb_sales): static
    {
        $this->nb_sales = $nb_sales;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function formatPrice(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Productimg>
     */
    public function getProductImgs(): Collection
    {
        return $this->productImgs;
    }

    public function addProductimg(Productimg $productimg): static
    {
        if (!$this->productImgs->contains($productimg)) {
            $this->productImgs->add($productimg);
            $productimg->setProduct($this);
        }

        return $this;
    }

    public function removeProductimg(Productimg $productimg): static
    {
        if ($this->productImgs->removeElement($productimg)) {
            // set the owning side to null (unless already changed)
            if ($productimg->getProduct() === $this) {
                $productimg->setProduct(null);
            }
        }

        return $this;
    }
}
