<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Song;
use App\Entity\Rating;
use App\Entity\SongUserRating;

class ListController extends AbstractController
{
    /**
     * @Route("/", name="songs")
     */
    public function showSongs(Request $request)
    {
        $songs = $this->getDoctrine()->getRepository(Song::class)->findAll();
        $ratings = $this->getDoctrine()->getRepository(Rating::class)->findAll();

        return $this->render('list/songs.html.twig', ['songs' => $songs, 'ratings' => $ratings]);
    }

    /**
     * @Route("/rate", name="rate")
     */
    public function rate(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $songId = $request->request->get('id');
        $ratingId = $request->request->get('grade');
        $submittedToken = $request->request->get('token');

        if (!$this->isCsrfTokenValid('rate_song', $submittedToken)) {
            return $this->render('list/error.html.twig', ['errorMessage' => 'Invalid token!']);
        }

        $songUserRating = new SongUserRating();
        $song = $this->getDoctrine()->getRepository(Song::class)->find($songId);
        $rating = $this->getDoctrine()->getRepository(Rating::class)->find($ratingId);
        $isSongRatedByUser = $this->getDoctrine()->getRepository(SongUserRating::class)->findOneBy(['song' => $song, 'user' => $this->getUser()]);
        
        if ($song === null) {
            return $this->render('list/error.html.twig', ['errorMessage' => 'Invalid Song!']);
        }

        if ($rating === null) {
            return $this->render('list/error.html.twig', ['errorMessage' => 'Invalid Rating!']);
        }

        if ($isSongRatedByUser) {
            return $this->render('list/error.html.twig', ['errorMessage' => 'You can rate songs only once!']);
        }

        $songUserRating->setSong($song);
        $songUserRating->setRating($rating);
        $songUserRating->setUser($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($songUserRating);
        $entityManager->flush();

        return $this->redirectToRoute('songs');
    }

}