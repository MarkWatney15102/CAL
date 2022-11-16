<?php

namespace src\Form\Storage\Place;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\StoragePlace\StoragePlace;

class StoragePlaceFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var StoragePlace $place */
        $place = $this->getModel('place');

        $this->addElement(
            [
                'id' => 'name',
                'type' => Element::TEXT,
                'label' => 'Name des Lagerorts',
                'read' => function () use ($place) {
                    if ($place instanceof StoragePlace && !empty($place->getName())) {
                        return $place->getName();
                    }

                    return "";
                },
                'write' => function ($value) use ($place) {
                    if ($place instanceof StoragePlace) {
                        $place->setName($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );
    }
}