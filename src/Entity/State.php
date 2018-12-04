<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StateRepository")
 */
class State
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventLog", mappedBy="state")
     */
    protected $event_log;

    /**
     * @ORM\OneToMany(targetEntity="EventRequest", mappedBy="state")
     */
    protected $event_request;

    /**
     * @return mixed
     */
    public function getEventRequest()
    {
        return $this->event_request;
    }

    /**
     * @param mixed $event_request
     */
    public function setEventRequest($event_request): void
    {
        $this->event_request = $event_request;
    }

    /**
     * @return mixed
     */
    public function getEventLog()
    {
        return $this->event_log;
    }

    /**
     * @param mixed $event_log
     */
    public function setEventLog($event_log): void
    {
        $this->event_log = $event_log;
    }

    /**
     * State constructor.
     */
    public function __construct()
    {
        $this->event_log = new ArrayCollection();
    }

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
}
