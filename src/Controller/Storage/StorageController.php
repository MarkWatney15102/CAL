<?php

namespace src\Controller\Storage;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\Storage\Item\StorageItemFormFactory;
use src\Form\Storage\Place\StoragePlaceFormFactory;
use src\Model\StorageItem\Mapper\StorageItemContainer;
use src\Model\StorageItem\Mapper\StorageItemMapper;
use src\Model\StorageItem\StorageItem;
use src\Model\StoragePlace\Mapper\StoragePlaceMapper;
use src\Model\StoragePlace\StoragePlace;
use src\Service\Storage\StorageItemService;
use src\Service\Storage\StoragePlaceService;

class StorageController extends AbstractController
{
    public function listStoragePlacesAction(): void
    {
        $storageService = new StoragePlaceService();

        $places = $storageService->getStoragePlaces();

        $this->render(
            'storage/place/list',
            [
                'renderWithBasicBody' => true,
                'places' => $places
            ]
        );
    }

    public function storagePlaceAction(): void
    {
        $placeId = (int)$this->urlParams[0];

        if ($placeId > 0) {
            $storageItemService = new StorageItemService();
            $items = $storageItemService->getItemsByStoragePlace($placeId);

            $storagePlace = StoragePlaceMapper::getInstance()->read($placeId);
        } else {
            $storagePlace = new StoragePlace();
        }

        $this->form = StoragePlaceFormFactory::make($storagePlace);

        $this->render(
            'storage/place/place',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'place' => $storagePlace,
                'items' => $items ?? null
            ]
        );
    }

    public function saveStoragePlaceAction(): void
    {
        $placeId = (int)$this->urlParams[0];

        if ($placeId > 0) {
            $storagePlace = StoragePlaceMapper::getInstance()->read($placeId);
        } else {
            $storagePlace = new StoragePlace();
        }

        $this->form = StoragePlaceFormFactory::make($storagePlace);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }

    public function itemAction(): void
    {
        $items = StorageItemContainer::getInstance()?->findBy([]);

        $this->render(
            'storage/items/list',
            [
                'renderWithBasicBody' => true,
                'items' => $items
            ]
        );
    }

    public function editItemAction(): void
    {
        $itemId = (int)$this->urlParams[0];

        if (!empty($itemId)) {
            $item = StorageItemMapper::getInstance()->read($itemId);
        } else {
            $item = new StorageItem();
        }

        $this->form = StorageItemFormFactory::make($item);

        $this->render(
            'storage/items/item',
            [
                'renderWithBasicBody' => true,
                'item' => $item,
                'form' => $this->form
            ]
        );
    }

    public function saveStorageItemAction(): void
    {
        $itemId = (int)$this->urlParams[0];

        if ($itemId > 0) {
            $storageItem = StorageItemMapper::getInstance()->read($itemId);
        } else {
            $storageItem = new StorageItem();
        }

        $this->form = StorageItemFormFactory::make($storageItem);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }
}