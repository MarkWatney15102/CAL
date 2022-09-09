<?php

declare(strict_types=1);

namespace lib\Form;

use Exception;
use lib\Element\AbstractElement;

abstract class AbstractForm
{
    private bool $executeRead = true;
    private bool $executeWrite = false;

    public function __construct(private string $formId, protected AbstractFormData $formData)
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
    }
}
