<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 */
class Service implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "The name must have at least 5 characters",
     *      maxMessage = "The name must have less than 256 characters"
     * )
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Job", mappedBy="service")
     */
    private $jobs;

    public function __construct(string $id = null, String $name = null)
    {
        $this->id = $id ?? $this->id;
        $this->name = $name;
        $this->jobs = new ArrayCollection();
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
    public function getName(): ?String
    {
        return $this->name;
    }
}
