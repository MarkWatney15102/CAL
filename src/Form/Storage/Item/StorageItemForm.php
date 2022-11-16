<?php

namespace src\Form\Storage\Item;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\StorageItem\Mapper\StorageItemMapper;
use src\Model\StorageItem\StorageItem;

class StorageItemForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var StorageItem $storageItem */
        $storageItem = $this->formData->getModel('item');

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

        if ($storageItem->getID() !== null) {
            if ($storageItem->getID() !== (int)$_POST['ean']) {
                StorageItemMapper::getInstance()?->delete($storageItem);

                $storageItem->setID((int)$_POST['ean']);

                $itemId = StorageItemMapper::getInstance()?->create($storageItem);
            } else {
                $itemId = StorageItemMapper::getInstance()?->update($storageItem);
            }
        } else {
            $itemId = StorageItemMapper::getInstance()?->create($storageItem);
        }

        header('Location: /storage/item/' . $itemId);
    }
}