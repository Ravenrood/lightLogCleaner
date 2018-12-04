<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventLogRepository")
 */
class EventLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $event;

    /**
     * @ORM\Column(type="datetime")
     */
    private $event_start_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $event_end_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getEventStartDate(): ?\DateTimeInterface
    {
        return $this->event_start_date;
    }

    public function setEventStartDate(\DateTimeInterface $event_start_date): self
    {
        $this->event_start_date = $event_start_date;

        return $this;
    }

    public function getEventEndDate(): ?\DateTimeInterface
    {
        return $this->event_end_date;
    }

    public function setEventEndDate(?\DateTimeInterface $event_end_date): self
    {
        $this->event_end_date = $event_end_date;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
