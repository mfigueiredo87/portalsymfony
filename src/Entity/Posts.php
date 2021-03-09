<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostsRepository::class)
 */
class Posts
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_publicacao;

    /**
     * @ORM\Column(type="string", length=80000)
     */
    private $conteudo;

    // Relacionamento um para muitos. Um post tem muitos comentarios
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comentarios", mappedBy="posts")
     */
    private $comentarios;

    // Um comentario pertence a um post
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(?string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDataPublicacao(): ?\DateTimeInterface
    {
        return $this->data_publicacao;
    }

    public function setDataPublicacao(\DateTimeInterface $data_publicacao): self
    {
        $this->data_publicacao = $data_publicacao;

        return $this;
    }

    public function getConteudo(): ?string
    {
        return $this->conteudo;
    }

    public function setConteudo(string $conteudo): self
    {
        $this->conteudo = $conteudo;

        return $this;
    }

   


}
