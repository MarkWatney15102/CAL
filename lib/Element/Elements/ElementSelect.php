<?php

declare(strict_types=1);

namespace lib\Element\Elements;

use lib\Element\AbstractElement;

class ElementSelect extends AbstractElement
{
    protected array $options = [];

    public function getHtml(): string
    {
        $class = $this->getClass() . ' form-control' ?? "";
        $id = $this->getId() ?? "";
        $value = (int)$this->getValue();
        $attributes = $this->getAttributes();

        $optionsHtml = $this->buildOptions($value);

        return <<<HTML
            <select name="{$id}" id="{$id}" class="{$class}" {$attributes}>
                {$optionsHtml}
            </select>
        HTML;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options, bool $defaultOption = false): self
    {
        if ($defaultOption) {
            $this->options[] = ['value' => -1, 'text' => 'Bitte wählen'];
        }

        foreach ($options as $option) {
            if (!empty($option['value']) && !empty($option['text'])) {
                $this->options[] = $option;
            }
        }

        return $this;
    }

    private function buildOptions(int $selected): string
    {
        $html = "";

        foreach ($this->options as $option) {
            $checked = ((int)$option['value'] === $selected) ? 'selected' : '';
            $html .= "<option value='{$option['value']}' {$checked}>{$option['text']}</option>";
        }

        return $html;
    }
}
