<?php

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementCheckbox extends AbstractElement
{
    public function getHtml(): string
    {
        $class = $this->getClass() . " form-check-input" ?? "";
        $id = $this->getId() ?? "";
        $checked = ((int)$this->getValue() > 0) ? 'checked' : '';
        $attributes = $this->getAttributes();

        return '<input type="checkbox" class="' . $class . '" name="' . $id . '" id="' . $id . '" ' . $attributes . ' ' . $checked .'>';
    }
}