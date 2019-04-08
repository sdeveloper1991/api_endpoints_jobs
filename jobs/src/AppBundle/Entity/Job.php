<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Datetime;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobRepository")
 */
class Job implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service", inversedBy="services",cascade={"persist"})
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Zipcode", inversedBy="zipcodes",cascade={"persist"})
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "The title must more than 4 characters",
     *      maxMessage = "The title must have less than 51 characters"
     * )
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $date_to_be_done;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string")
     */
    private $zipcode_id;

    /**
     * @ORM\Column(type="string")
     */
    private $service_id;

    public function __construct(
        string $id = null,
        string $serviceId = null,
        string $zipcodeId = null,
        String $title = null,
        String $description = null,
        \DateTimeInterface $dateToBeDone = null
    ) {
        $this->id = $id ?? $this->id;
        $this->service_id = $serviceId ?? $this->service_id;
        $this->zipcode_id = $zipcodeId ?? $this->zipcode_id;
        $this->title = $title;
        $this->description = $description;
        $this->date_to_be_done = $dateToBeDone;
        $this->created_at = new DateTime();
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getZipcodeId(): ?string
    {
        return $this->zipcode_id;
    }

    /**
     * @return null|string
     */
    public function getServiceId(): ?string
    {
        return $this->service_id;
    }

    /**
     * @return null|String
     */
    public function getTitle(): ?String
    {
        return $this->title;
    }

    /**
     * @return null|String
     */
    public function getDescription(): ?String
    {
        return $this->description;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateToBeDone(): ?\DateTimeInterface
    {
        return $this->date_to_be_done;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @return null|String
     */
    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return null|String
     */
    public function getZipcode(): ?zipcode
    {
        return $this->zipcode;
    }

    public function setZipcode(?Zipcode $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
