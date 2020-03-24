<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/board-game")
 */
class boardGameController extends AbstractController
{

    /**
    * @Route("", methods="GET")
     */
    public function index(boardGameRepository $repository)
    {
        $boardGames = $repository->findAll();

        return $this->render('board_game/index.html.twig', [
            'board_games' => $boardGames,
        ]);
    }
}