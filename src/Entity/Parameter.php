<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
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
    private $inName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $outName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStatic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $valueStatic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soapTree;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $flow;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Api", inversedBy="parameters")
     */
    private $api;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInName(): ?string
    {
        return $this->inName;
    }

    public function setInName(string $inName): self
    {
        $this->inName = $inName;

        return $this;
    }

    public function getOutName(): ?string
    {
        return $this->outName;
    }

    public function setOutName(string $outName): self
    {
        $this->outName = $outName;

        return $this;
    }

    public function getIsStatic(): ?bool
    {
        return $this->isStatic;
    }

    public function setIsStatic(bool $isStatic): self
    {
        $this->isStatic = $isStatic;

        return $this;
    }

    public function getValueStatic(): ?string
    {
        return $this->valueStatic;
    }

    public function setValueStatic(?string $valueStatic): self
    {
        $this->valueStatic = $valueStatic;

        return $this;
    }

    public function getSoapTree(): ?string
    {
        return $this->soapTree;
    }

    public function setSoapTree(?string $soapTree): self
    {
        $this->soapTree = $soapTree;

        return $this;
    }

    public function getFlow(): ?string
    {
        return $this->flow;
    }

    public function setFlow(string $flow): self
    {
        $this->flow = $flow;

        return $this;
    }

    public function getApi(): ?Api
    {
        return $this->api;
    }

    public function setApi(?Api $api): self
    {
        $this->api = $api;

        return $this;
    }
}
