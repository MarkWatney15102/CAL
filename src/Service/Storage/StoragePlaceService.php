<?php

namespace src\Service\Storage;

use src\Model\StoragePlace\Mapper\StoragePlaceContainer;

class StoragePlaceService
{
    public function getStoragePlaces(): array
    {
        $places = StoragePlaceContainer::getInstance()?->findBy([]);

        return $places;
    }
}