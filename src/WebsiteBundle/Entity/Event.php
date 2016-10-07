<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\WebsiteBundle\Entity\Band")
     * @ORM\JoinColumn(name="band_id", referencedColumnName="id")
     */
    private $band;

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=255)
     */
    private $venue;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set band
     *
     * @param \WebsiteBundle\Band $band
     *
     * @return Event
     */
    public function setBand(\WebsiteBundle\Entity\Band $band = null)
    {
        $this->band = $band;

        return $this;
    }

    /**
     * Get band
     *
     * @return \WebsiteBundle\EntityBand
     */
    public function getBand()
    {
        return $this->band;
    }
}
