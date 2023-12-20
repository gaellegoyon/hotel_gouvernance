<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: chambre::class)]
    private Collection $chambre;

    #[ORM\ManyToMany(mappedBy: 'reservation', targetEntity: service::class)]
    private Collection $service;

    #[ORM\Column(length: 255)]
    private ?string $nom_client = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombre_client = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $tel_client = null;

    #[ORM\Column(length: 255)]
    private ?string $email_client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, chambre>
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(chambre $chambre): static
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre->add($chambre);
            $chambre->setReservation($this);
        }

        return $this;
    }

    public function removeChambre(chambre $chambre): static
    {
        if ($this->chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getReservation() === $this) {
                $chambre->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(service $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setReservation($this);
        }

        return $this;
    }

    public function removeService(service $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getReservation() === $this) {
                $service->setReservation(null);
            }
        }

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): static
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getNombreClient(): ?int
    {
        return $this->nombre_client;
    }

    public function setNombreClient(?int $nombre_client): static
    {
        $this->nombre_client = $nombre_client;

        return $this;
    }

    public function getTelClient(): ?string
    {
        return $this->tel_client;
    }

    public function setTelClient(?string $tel_client): static
    {
        $this->tel_client = $tel_client;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->email_client;
    }

    public function setEmailClient(string $email_client): static
    {
        $this->email_client = $email_client;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }
}
