<?php

namespace src\Form\Storage\Item;


use src\Model\StorageItem\StorageItem;

class StorageItemFormFactory
{
    public static function make(StorageItem $storagePlace): StorageItemForm
    {
        $formData = new StorageItemFormData();

        $formData->addModel($storagePlace, 'item');

        $formData->initStructure();

        return new StorageItemForm('storageItemForm', $formData);
    }
}