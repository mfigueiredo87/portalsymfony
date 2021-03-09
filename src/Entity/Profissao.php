<?php

namespace App\Entity;

use App\Repository\ProfissaoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfissaoRepository::class)
 */
class Profissao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

   // Relacionamento com a Entidade Profissao
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="profissao")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
}
