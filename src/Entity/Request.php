<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RequestRepository")
 * @ORM\Table(name="request")
 */
class Request
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Api", inversedBy="requests")
     */
    private $api;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $iporigin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dumpEntryIn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dumpEntryOut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dumpResponseIn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dumpResponseOut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getIporigin(): ?string
    {
        return $this->iporigin;
    }

    public function setIporigin(?string $iporigin): self
    {
        $this->iporigin = $iporigin;

        return $this;
    }

    public function getDumpEntryIn(): ?string
    {
        return $this->dumpEntryIn;
    }

    public function setDumpEntryIn(?string $dumpEntryIn): self
    {
        $this->dumpEntryIn = $dumpEntryIn;

        return $this;
    }

    public function getDumpEntryOut(): ?string
    {
        return $this->dumpEntryOut;
    }

    public function setDumpEntryOut(?string $dumpEntryOut): self
    {
        $this->dumpEntryOut = $dumpEntryOut;

        return $this;
    }

    public function getDumpResponseIn(): ?string
    {
        return $this->dumpResponseIn;
    }

    public function setDumpResponseIn(?string $dumpResponseIn): self
    {
        $this->dumpResponseIn = $dumpResponseIn;

        return $this;
    }

    public function getDumpResponseOut(): ?string
    {
        return $this->dumpResponseOut;
    }

    public function setDumpResponseOut(?string $dumpResponseOut): self
    {
        $this->dumpResponseOut = $dumpResponseOut;

        return $this;
    }
}
