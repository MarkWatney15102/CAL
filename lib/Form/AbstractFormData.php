<?php

declare(strict_types=1);

namespace lib\Form;

use Exception;
use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSelect;
use lib\Model\AbstractEntity;

abstract class AbstractFormData
{
    abstract public function initStructure(): void;

    private array $elements = [];
    private array $models = [];

    /**
     * @throws Exception
     */
    public function addElement(array $structure): self
    {
        if (
            !isset($structure['type']) &&
            !isset($structure['id'])
        ) {
            throw new Exception('Invalid structure');
        }

        $element = $structure['type']->getClass();

        if ($element instanceof AbstractElement) {
            $element->setId($structure['id']);

            if (isset($structure['label'])) {
                $element->setLabel($structure['label']);
            }

            if (isset($structure['class'])) {
                $element->setClass($structure['class']);
            }

            if (isset($structure['read'])) {
                $closure = $structure['read'];

                $element->setValue(call_user_func_array($closure, []));
            }

            if (isset($structure['write'])) {
                $closure = $structure['write'];

                $element->setWrite($closure);
            }

            if (isset($structure['attributes'])) {
                $element->setAttributes($structure['attributes']);
            }

            if ($element instanceof ElementSelect) {
                if (isset($structure['options'])) {
                    $element->setOptions(
                        $structure['options'],
                        (bool)$structure['defaultOption']
                    );
                }
            }
            $this->elements[$element->getId()] = $element;
        }

        return $this;
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function addModel(AbstractEntity $model, string $modelAlias): self
    {
        $this->models[$modelAlias] = $model;

        return $this;
    }

    public function getModel(string $modelAlias): AbstractEntity|null
    {
        if (key_exists($modelAlias, $this->models) && $this->models[$modelAlias] instanceof AbstractEntity) {
            return $this->models[$modelAlias];
        }

        return null;
    }

    public function getModels(): array
    {
        return $this->models;
    }
}
