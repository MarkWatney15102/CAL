<?php

namespace src\Controller\Api;

use lib\Controller\AbstractController;
use src\Model\StorageItem\Mapper\StorageItemMapper;
use src\Model\StorageItem\StorageItem;
use src\Model\StorageItemToPlace\Mapper\StorageItemToPlaceContainer;
use src\Model\StorageItemToPlace\Mapper\StorageItemToPlaceMapper;
use src\Model\StorageItemToPlace\StorageItemToPlace;

class ApiController extends AbstractController
{
    public function bookoutStorageItemAction(): void
    {
        $message = "Es ist ein Fehler aufgetreten";
        $data = json_decode(file_get_contents('php://input'));

        $ean = (int)$data->bookOutEan;
        $amount = (int)$data->bookOutAmount;
        $place = (int)$data->place;
        $row = (int)$data->row;
        $position = (int)$data->position;

        if ($amount > 0) {
            if (!empty($ean) && !empty($place) && !empty($row) && !empty($position)) {
                $itemToPlace = StorageItemToPlaceContainer::getInstance()?->findOne(['ean' => $ean, 'placeId' => $place, 'row' => $row, 'position' => $position]);

                if ($itemToPlace instanceof StorageItemToPlace) {
                    $modelAmount = (int)$itemToPlace->getAmount();
                    if ($modelAmount >= $amount) {
                        $modelAmount = $modelAmount - $amount;

                        $itemToPlace->setAmount($modelAmount);

                        StorageItemToPlaceMapper::getInstance()?->update($itemToPlace);
                        $message = "Artikel wurden ausgebucht";
                    } else {
                        $message = "Es wurde versucht mehr auszubuchen als verfügbar sind";
                    }
                }
            } else {
                $message = "Es Fehlen Werte";
            }
        } else {
            $message = "Der auszubuchende Artikel darf nicht 0 sein";
        }

        $this->renderJson(['message' => $message]);
    }

    public function bookinStorageItemAction(): void
    {
        $message = "Es ist ein Fehler aufgetreten";
        $data = json_decode(file_get_contents('php://input'));

        $ean = (int)$data->ean;
        $amount = (int)$data->amount;
        $place = (int)$data->place;
        $row = (int)$data->row;
        $position = (int)$data->position;

        /** @var StorageItemToPlaceMapper $storageItemToPlaceMapper */
        $storageItemToPlaceMapper = StorageItemToPlaceMapper::getInstance();

        if (!empty($ean) && !empty($amount) && !empty($place) && !empty($row) && !empty($position)) {
            $item = StorageItemMapper::getInstance()?->read($ean);
            if ($item instanceof StorageItem) {
                $assignment = StorageItemToPlaceContainer::getInstance()?->findOne(
                    [
                        'ean' => $ean,
                        'placeId' => $place,
                        'row' => $row,
                        'position' => $position
                    ]
                );
                if ($assignment instanceof StorageItemToPlace) {
                    $newAmount = $assignment->getAmount() + $amount;

                    $assignment->setAmount($newAmount);

                    $storageItemToPlaceMapper->update($assignment);
                } else {
                    $assignment = new StorageItemToPlace();
                    $assignment->setPlaceId($place);
                    $assignment->setEan($ean);
                    $assignment->setRow($row);
                    $assignment->setPosition($position);
                    $assignment->setAmount($amount);

                    $storageItemToPlaceMapper->create($assignment);
                }
            } else {
                $message = "Die Artikel mit der angegebenen EAN existiert nicht";
            }
        } else {
            $message = "Es fehlen Informationen um den Arikel einzubuchen";
        }

        $this->renderJson(['message' => $message]);
    }
}