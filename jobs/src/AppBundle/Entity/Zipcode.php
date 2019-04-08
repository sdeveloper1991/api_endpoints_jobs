<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZipcodeRepository")
 */
class Zipcode implements EntityInterface
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "The code must have exactly 5 characters",
     *      maxMessage = "The code must have exactly 5 characters"
     * )
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "The city must have at least 5 characters",
     *      maxMessage = "The city must have less than 256 characters"
     * )
     * @Assert\NotBlank()
     */
    private $city;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Job", mappedBy="service")
     */
    private $jobs;

    public function __construct(string $id = null, String $city = null, String $code = null)
    {
        $this->id = $id ?? $this->id;
        $this->city = $city;
        $this->code = $code;
        $this->jobs = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?String
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?String
    {
        return $this->code;
    }
}
