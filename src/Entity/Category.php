<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Api", mappedBy="category")
     */
    private $apis;

    public function __construct()
    {
        $this->apis = new ArrayCollection();
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

    /**
     * @return Collection|Api[]
     */
    public function getApis(): Collection
    {
        return $this->apis;
    }

    public function addApi(Api $api): self
    {
        if (!$this->apis->contains($api)) {
            $this->apis[] = $api;
            $api->setCategory($this);
        }

        return $this;
    }

    public function removeApi(Api $api): self
    {
        if ($this->apis->contains($api)) {
            $this->apis->removeElement($api);
            // set the owning side to null (unless already changed)
            if ($api->getCategory() === $this) {
                $api->setCategory(null);
            }
        }

        return $this;
    }
}
