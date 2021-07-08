<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     * message = "Grade cannot be blank."
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 10,
     *      notInRangeMessage = "Grade be between {{ min }} and {{ max }} "
     * )
     */
    private $grade;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\SongUserRating", mappedBy="rating")
     */
    private $ratedSongs;

    public function __construct() {
        $this->ratedSongs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getRatedSongs()
    {
        return $this->ratedSongs;
    }

    public function setRatedSongs($ratedSongs): self
    {
        $this->ratedSongs = $ratedSongs;

        return $this;
    }
}
