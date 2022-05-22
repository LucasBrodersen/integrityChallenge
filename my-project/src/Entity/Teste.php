<?php

namespace App\Entity;

use App\Repository\TesteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TesteRepository::class)]
class Teste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $colunaum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColunaum(): ?string
    {
        return $this->colunaum;
    }

    public function setColunaum(string $colunaum): self
    {
        $this->colunaum = $colunaum;

        return $this;
    }
}
