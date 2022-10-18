<?php

namespace src\Service\Storage;

use src\Model\StorageItem\Mapper\StorageItemMapper;
use src\Model\StorageItem\StorageItem;
use src\Model\StorageItemToPlace\Mapper\StorageItemToPlaceContainer;
use src\Model\StorageItemToPlace\StorageItemToPlace;

class StorageItemService
{
    public function getItemsByStoragePlace(int $storagePlaceId): array|null
    {
        $list = null;

        /** @var StorageItemToPlace[] $itemsToPlace */
        $itemsToPlace = StorageItemToPlaceContainer::getInstance()?->findBy(['placeId' => $storagePlaceId]);

        foreach ($itemsToPlace as $itemToPlace) {
            $itemId = $itemToPlace->getEan();

            $item = StorageItemMapper::getInstance()?->read($itemId);

            if ($item instanceof StorageItem) {
                $list[] = ['mapping' => $itemToPlace, 'item' => $item];
            }
        }

        return $list;
    }
}