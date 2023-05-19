<?php

namespace App\Entity;

use App\Repository\RoutineFormRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoutineFormRepository::class)
 */
class RoutineForm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $days = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $office_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $office_end;

    /**
     * @ORM\Column(type="boolean")
     */
    private $use_public_transport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $workout;

    public function __construct($days, $office_start, $office_end, $use_public_transport, $workout)
    {
        $this->days = $days;
        $this->office_start = $office_start;
        $this->office_end = $office_end;
        $this->use_public_transport = $use_public_transport;
        $this->workout = $workout;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDays(): ?array
    {
        return $this->days;
    }

    public function setDays(array $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getOfficeStart(): ?\DateTimeInterface
    {
        return $this->office_start;
    }

    public function setOfficeStart(\DateTimeInterface $office_start): self
    {
        $this->office_start = $office_start;

        return $this;
    }

    public function getOfficeEnd(): ?\DateTimeInterface
    {
        return $this->office_end;
    }

    public function setOfficeEnd(\DateTimeInterface $office_end): self
    {
        $this->office_end = $office_end;

        return $this;
    }

    public function isUsePublicTransport(): ?bool
    {
        return $this->use_public_transport;
    }

    public function setUsePublicTransport(bool $use_public_transport): self
    {
        $this->use_public_transport = $use_public_transport;

        return $this;
    }

    public function getworkout(): ?string
    {
        return $this->workout;
    }

    public function setworkout(string $workout): self
    {
        $this->workout = $workout;

        return $this;
    }
}
