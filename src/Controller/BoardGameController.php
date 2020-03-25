<?php


namespace App\Controller;


use App\Entity\BoardGame;
use App\Form\BoardGameType;
use App\Repository\BoardGameRepository;
//use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    * @Route("/new",
     *      methods={"GET", "POST"},
     *      name="board_game_add"
     *)
     *
     * @Route("/{id}/edit",
     *      methods={"GET", "PUT"},
     *      name="board_game_edit"
     * )
     */
    public function form(Request $request, EntityManagerInterface $manager, BoardGame $game = null)
    {
        if(!$game)
        {
            $game = new BoardGame();
            $form = $this->createForm( BoardGameType::class, $game);
        }
        else {
            $form = $this->createForm(BoardGameType::class, $game, [
                'method' => "PUT"
            ]);
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($game);
            $manager->flush();

            $this->addFlash('success', 'Nouveau jeu créer');

            return $this->redirectToRoute('board_game_show', [
                'id' => $game->getId(),
            ]);
        }

        return $this->render('board_game/form.html.twig', [
            'new_form' => $form->createView(),
            'board_game' => $game
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