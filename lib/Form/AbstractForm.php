<?php

declare(strict_types=1);

namespace lib\Form;

use Exception;
use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Model\AbstractEntity;

abstract class AbstractForm
{
    private bool $executeRead = true;
    private bool $executeWrite = false;

    public function __construct(private readonly string $formId, protected AbstractFormData $formData)
    {
    }

    public function getFormId(): string
    {
        return $this->formId;
    }

    public function getFormData(): AbstractFormData
    {
        return $this->formData;
    }

    public function getElement(string $id): AbstractElement
    {
        $elements = $this->formData->getElements();
        $element = $elements[$id];

        if (!$element instanceof AbstractElement) {
            throw new Exception('Element dont exists');
        }

        return $element;
    }

    public function open(): string
    {
        return '<form method="POST">';
    }

    public function close(): string
    {
        return '</form>';
    }

    public function save(): void
    {
        $formData = $this->getFormData();
        $elements = $formData->getElements();

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

        /** @var AbstractEntity[] $models */
        $models = $formData->getModels();


        $uri = $_SERVER['REQUEST_URI'];
        $i = 0;
        foreach ($models as $model) {
            $mapperClass = $model->getMapperClass();

            if ($model->getID() !== null) {
                $mapperClass?->update($model);
            } else {
                $id = $mapperClass?->create($model);
                if ($i === 0) {
                    $uri = str_replace("0", "" .$id, $_SERVER['REQUEST_URI']);
                }
            }
            $i++;
        }

        header('Location:' . $uri);
    }
}
