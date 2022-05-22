<?php

namespace App\Entity;

use App\Repository\FinalHeadersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinalHeadersRepository::class)]
class FinalHeaders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $FinalUrl;

    #[ORM\Column(type: 'string', length: 255)]
    private $Headers;

    #[ORM\Column(type: 'text')]
    private $HeaderValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFinalUrl(): ?string
    {
        return $this->FinalUrl;
    }

    public function setFinalUrl(string $FinalUrl): self
    {
        $this->FinalUrl = $FinalUrl;

        return $this;
    }

    public function getHeaders(): ?string
    {
        return $this->Headers;
    }

    public function setHeaders(string $Headers): self
    {
        $this->Headers = $Headers;

        return $this;
    }

    public function getHeaderValue(): ?string
    {
        return $this->HeaderValue;
    }

    public function setHeaderValue(?string $HeaderValue): self
    {
        $this->HeaderValue = $HeaderValue;

        return $this;
    }
}
