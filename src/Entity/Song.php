<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SongRepository::class)
 */
class Song
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "Grade cannot be blank."
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Title cannot contain a number"
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      minMessage = "Title must be at least {{ limit }} characters long",
     *      maxMessage = "Title cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $title;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\SongUserRating", mappedBy="song", fetch="EAGER")
     */
    private $songRatings;


    public function __construct() {
        $this->songRatings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSongRatings()
    {
        return $this->songRatings;
    }

    public function setSongRatings($songRatings): self
    {
        $this->songRatings = $songRatings;

        return $this;
    }


}
