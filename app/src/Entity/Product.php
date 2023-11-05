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
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
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

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: StockStore::class)]
    private Collection $stockStores;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetail::class)]
    private Collection $orderDetails;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImg::class, orphanRemoval: true)]
    private Collection $productImgs;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'supplier_code', referencedColumnName: 'code', nullable: false)]
    private ?Supplier $supplier = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: StockWeb::class)]
    private Collection $stockWebs;

    public function __construct()
    {
        $this->stockStores = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
        $this->productImgs = new ArrayCollection();
        $this->stockWebs = new ArrayCollection();
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
     * @return Collection<int, StockStore>
     */
    public function getStockStores(): Collection
    {
        return $this->stockStores;
    }

    public function addStockStore(StockStore $stock_store): static
    {
        if (!$this->stockStores->contains($stock_store)) {
            $this->stockStores->add($stock_store);
            $stock_store->setProduct($this);
        }

        return $this;
    }

    public function removeStockStore(StockStore $stock_store): static
    {
        if ($this->stockStores->removeElement($stock_store)) {
            // set the owning side to null (unless already changed)
            if ($stock_store->getProduct() === $this) {
                $stock_store->setProduct(null);
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

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): static
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return Collection<int, StockWeb>
     */
    public function getStockWebs(): Collection
    {
        return $this->stockWebs;
    }

    public function addStockWeb(StockWeb $stockWeb): static
    {
        if (!$this->stockWebs->contains($stockWeb)) {
            $this->stockWebs->add($stockWeb);
            $stockWeb->setProduct($this);
        }

        return $this;
    }

    public function removeStockWeb(StockWeb $stockWeb): static
    {
        if ($this->stockWebs->removeElement($stockWeb)) {
            // set the owning side to null (unless already changed)
            if ($stockWeb->getProduct() === $this) {
                $stockWeb->setProduct(null);
            }
        }

        return $this;
    }
}
