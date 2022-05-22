<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestRepository::class)]
class Request
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstURL;

    #[ORM\Column(type: 'string', length: 255)]
    private $finalURL;

    #[ORM\Column(type: 'string', length: 30)]
    private $DateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstURL(): ?string
    {
        return $this->firstURL;
    }

    public function setFirstURL(string $firstURL): self
    {
        $this->firstURL = $firstURL;

        return $this;
    }

    public function getFinalURL(): ?string
    {
        return $this->finalURL;
    }

    public function setFinalURL(string $finalURL): self
    {
        $this->finalURL = $finalURL;

        return $this;
    }

    public function getDateTime(): ?string
    {
        return $this->DateTime;
    }

    public function setDateTime(string $DateTime): self
    {
        $this->DateTime = $DateTime;

        return $this;
    }
}
