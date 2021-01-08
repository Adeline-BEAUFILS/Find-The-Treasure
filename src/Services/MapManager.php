<?php

namespace App\Services;

use App\Repository\TileRepository;

/**
* Class MapManagerService
* @package App\Services
*/
class MapManager
{
    /**
     * @var TileRepository
     */
    private $tileRepository;

    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;
    }

    function tileExists(int $coordX, int $coordY): bool
    {
        $tileExists = $this->tileRepository->findTile($coordX, $coordY);

        if ($tileExists === null) {
            return false;
        } else {
            return true;
        }
    }
}