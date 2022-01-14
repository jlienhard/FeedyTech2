<?php

namespace App\Entity;

use App\Repository\SitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SitesRepository::class)]
class Sites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $source_url;

    #[ORM\Column(type: 'string', length: 255)]
    private $rss_url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $icon_url;

    #[ORM\Column(type: 'datetime')]
    private $creates_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $update_at;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSourceUrl(): ?string
    {
        return $this->source_url;
    }

    public function setSourceUrl(string $source_url): self
    {
        $this->source_url = $source_url;

        return $this;
    }

    public function getRssUrl(): ?string
    {
        return $this->rss_url;
    }

    public function setRssUrl(string $rss_url): self
    {
        $this->rss_url = $rss_url;

        return $this;
    }

    public function getIconUrl(): ?string
    {
        return $this->icon_url;
    }

    public function setIconUrl(?string $icon_url): self
    {
        $this->icon_url = $icon_url;

        return $this;
    }

    public function getCreatesAt(): ?\DateTimeInterface
    {
        return $this->creates_at;
    }

    public function setCreatesAt(\DateTimeInterface $creates_at): self
    {
        $this->creates_at = $creates_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
}
