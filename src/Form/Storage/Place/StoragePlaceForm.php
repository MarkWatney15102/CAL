<?php

namespace src\Form\Storage\Place;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\StoragePlace\Mapper\StoragePlaceMapper;
use src\Model\StoragePlace\StoragePlace;

class StoragePlaceForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var StoragePlace $place */
        $place = $this->formData->getModel('place');

        foreach ($elements as $element) {
            if ($element instanceof AbstractElement && !$element instanceof ElementSubmit) {
                if (array_key_exists($element->getId(), $_POST)) {
                    $newValue = $_POST[$element->getId()];
                    if (!empty($element->getWrite())) {
                        call_user_func($element->getWrite(), $newValue);
                    }
                }
            }
        }

        if ($place->getID() !== null) {
            $placeId = StoragePlaceMapper::getInstance()?->update($place);
        } else {
            $placeId = StoragePlaceMapper::getInstance()?->create($place);
        }

        header('Location: /storage/place/' . $placeId);
    }
}