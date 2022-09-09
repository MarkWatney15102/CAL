<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementSubmit extends AbstractElement
{
    public function getHtml(): string
    {
        $class = "btn btn-outline-primary" . $this->getClass() ?? "";
        $id = $this->getId() ?? "";
        $label = $this->getLabel();

        return '<input type="submit" class="' . $class . '" name="' . $id . '" id="' . $id . '" value="' . $label . '">';
    }
}
