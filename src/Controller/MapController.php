<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tile;
use App\Repository\BoatRepository;
use App\Entity\Boat;
use App\Repository\TileRepository;
use App\Services\MapManager;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function displayMap(BoatRepository $boatRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $boatRepository->findOneBy([]);

        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
        ]);
    }

    /**
     * @Route("/start", name="start"))
     */
    public function start(BoatRepository $boatRepository, TileRepository $tileRepository, MapManager $service): Response
    {
        $boat = new Boat();
        $tile = new Tile();
        $boat = $boatRepository->findOneBy([]);
        $tiles = $tileRepository->findBy(['type' => 'island']);
        $boat->setCoordX(0);
        $boat->setCoordY(0);
        foreach($tiles as $value) {
            $value->setHasTreasure(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        }
        $tile = $service->getRandomIsland();
        $tile->setHasTreasure(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('map');
    }
}
