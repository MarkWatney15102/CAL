<?php

namespace src\Form\Storage\Place;

use src\Model\StoragePlace\Mapper\StoragePlaceMapper;
use src\Model\StoragePlace\StoragePlace;

class StoragePlaceFormFactory
{
    public static function make(StoragePlace $storagePlace): StoragePlaceForm
    {
        $formData = new StoragePlaceFormData();

        $formData->addModel($storagePlace, 'place');

        $formData->initStructure();

        return new StoragePlaceForm('storagePlaceForm', $formData);
    }
}