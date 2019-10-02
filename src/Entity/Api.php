<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiRepository")
 * @ORM\Table(name="api")
 */
class Api
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $headers = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endpoint;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $method;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $soapTemplate;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $decisionParam;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $bodyFormat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="apis")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partner", inversedBy="apis")
     */
    private $partner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Technology", inversedBy="apis")
     */
    private $techno;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="api" ,cascade={"persist"})
     */
    private $parameters;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valueSuccess;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $xmltagversion;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $methodin;


    public function __construct()
    {
        $this->parameters = new ArrayCollection();
        $this->requests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function setHeaders(?array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getSoapTemplate(): ?string
    {
        return $this->soapTemplate;
    }

    public function setSoapTemplate(?string $soapTemplate): self
    {
        $this->soapTemplate = $soapTemplate;

        return $this;
    }

    public function getDecisionParam(): ?string
    {
        return $this->decisionParam;
    }

    public function setDecisionParam(string $decisionParam): self
    {
        $this->decisionParam = $decisionParam;

        return $this;
    }

   
    public function getBodyFormat(): ?string
    {
        return $this->bodyFormat;
    }

    public function setBodyFormat(string $bodyFormat): self
    {
        $this->bodyFormat = $bodyFormat;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getTechno(): ?Technology
    {
        return $this->techno;
    }

    public function setTechno(?Technology $techno): self
    {
        $this->techno = $techno;

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->setApi($this);
        }

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        if ($this->parameters->contains($parameter)) {
            $this->parameters->removeElement($parameter);
            // set the owning side to null (unless already changed)
            if ($parameter->getApi() === $this) {
                $parameter->setApi(null);
            }
        }

        return $this;
    }

    public function getValueSuccess(): ?string
    {
        return $this->valueSuccess;
    }

    public function setValueSuccess(string $valueSuccess): self
    {
        $this->valueSuccess = $valueSuccess;

        return $this;
    }

   
    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
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

    public function getXmltagversion(): ?string
    {
        return $this->xmltagversion;
    }

    public function setXmltagversion(?string $xmltagversion): self
    {
        $this->xmltagversion = $xmltagversion;

        return $this;
    }

    public function getMethodin(): ?string
    {
        return $this->methodin;
    }

    public function setMethodin(string $methodin): self
    {
        $this->methodin = $methodin;

        return $this;
    }
}
