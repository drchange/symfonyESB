<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurlConfigRepository")
 */
class CurlConfig
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timeout;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifypeer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifyhost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    public function setTimeout(?int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getVerifypeer(): ?bool
    {
        return $this->verifypeer;
    }

    public function setVerifypeer(bool $verifypeer): self
    {
        $this->verifypeer = $verifypeer;

        return $this;
    }

    public function getVerifyhost(): ?bool
    {
        return $this->verifyhost;
    }

    public function setVerifyhost(bool $verifyhost): self
    {
        $this->verifyhost = $verifyhost;

        return $this;
    }
}
