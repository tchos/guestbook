<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConferenceRepository;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    /**
     * @Route("/", name="homepage")
     */
    public function index(ConferenceRepository $conferenceRepository)
    {
        $repos = $conferenceRepository->findAll();

        return new Response ($this->twig->render('conference/index.html.twig', [
            'conferences' => '$repos',
        ]));
    }

    /**
     * @Route("/conference/{id}", name="conference")
     */
    public function show(Conference $conference, CommentRepository $commentRepository)
    {
        $repos = $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']);
        
        return new Response ($this->twig->render('conference/show.html.twig',[
            'conference' => $conference,
            'comments' => $repos,
        ]));
    }
}
