<?php

namespace App\Entity;

use App\Repository\SongUserRatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SongUserRatingRepository::class)
 */
class SongUserRating
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Song", inversedBy="songRatings", fetch="EAGER")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(
     * message = "Song should not be blank."
     * )
     */
    private $song;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userRatedSongs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(
     * message = "User should not be blank."
     * )
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rating", inversedBy="ratedSongs")
     * @ORM\JoinColumn(name="rating_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(
     * message = "Rating should not be blank."
     * )
     */
    private $rating;


    public function getSong()
    {
        return $this->song;
    }

    public function setSong(Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating(Rating $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    
}
