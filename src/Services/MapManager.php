<?php

namespace App\Service;

use App\Repository\TileRepository;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\Response;


Class MapManager
{
    /**
     * @return bool
     */
    public function tileExists(int $x, int $y, TileRepository $tileRepository): bool
    {
        $tile = $tileRepository->findAll();
        $coordinates[]=$x;
        $coordinates[]=$y;
        if(in_array($coordinates, $tile)){
            return true;
        } else{
            return false;
        }
    }
}