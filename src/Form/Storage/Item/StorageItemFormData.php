<?php

namespace src\Form\Storage\Item;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\StorageItem\StorageItem;

class StorageItemFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var StorageItem $item */
        $item = $this->getModel('item');

        $this->addElement(
            [
                'id' => 'ean',
                'type' => Element::TEXT,
                'label' => 'EAN',
                'read' => function () use ($item) {
                    if ($item instanceof StorageItem && !empty($item->getID())) {
                        return $item->getID();
                    }

                    return "";
                },
                'attributes' => (empty($item->getID())) ? 'disabled' : ''
            ]
        )->addElement(
            [
                'id' => 'name',
                'type' => Element::TEXT,
                'label' => 'Name',
                'read' => function () use ($item) {
                    if ($item instanceof StorageItem && !empty($item->getName())) {
                        return $item->getName();
                    }

                    return "";
                },
                'write' => function ($value) use ($item) {
                    if ($item instanceof StorageItem) {
                        $item->setName($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'description',
                'type' => Element::TEXTAREA,
                'label' => 'Beschreibung',
                'read' => function () use ($item) {
                    if ($item instanceof StorageItem && !empty($item->getDescription())) {
                        return $item->getDescription();
                    }

                    return "";
                },
                'write' => function ($value) use ($item) {
                    if ($item instanceof StorageItem) {
                        $item->setDescription($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );;
    }
}