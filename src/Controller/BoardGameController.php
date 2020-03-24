<?php


namespace App\Controller;


use App\Entity\BoardGame;
use App\Repository\BoardGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/board-game")
 */
class BoardGameController extends AbstractController
{

    /**
    * @Route("",
     *     methods="GET",
     *     name="board_game_index"
     * )
     */
    public function index(BoardGameRepository $repository)
    {
        $boardGames = $repository->findAll();

        return $this->render('board_game/index.html.twig', [
            'board_games' => $boardGames,
        ]);
    }

    /**
     * @Route("/{id}",
     *     methods="GET",
     *     name="board_game_show",
     *     requirements={
                "id" = "\d+"
     *     }
     * )
     *
     */
    public function show(BoardGame $boardGame)
    {
        /*
         composant ParamConverter est capable de traduire un paramètre en route
            -Entité
            -\DateTime
         */

        return $this->render('board_game/show.html.twig', [
            'board_game' => $boardGame,
        ]);
    }

    /**
    * @Route("/{id}",
     *     methods="GET",
     *     name="board_game_show",
     *     requirements={
                "id" = "\d+"
     *     })
     */
    /*
    public function show(int $id, BoardGameRepository $repository)
    {
        $boarGame = $repository->find($id);

        //verifie si l'id du jeu existe
        if(!$boarGame)
            throw $this->createNotFoundException('ce jeu n\' existe pas');

        return $this->render('board_game/show.html.twig', [
            'board_game' => $boarGame,
        ]);
    }
    */
}