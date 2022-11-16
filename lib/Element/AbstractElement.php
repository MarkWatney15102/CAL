<?php

declare(strict_types=1);

namespace lib\Element;

use Closure;

abstract class AbstractElement
{
    protected string $id = "";
    protected string $label = "";
    protected string $class = "";
    protected string|int $value = "";
    protected Closure $write;
    protected string $attributes = "";

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function label(): string
    {
        return "<label for='{$this->getId()}'>{$this->label}</label>";
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function getValue(): string|int
    {
        return $this->value;
    }

    public function setValue(string|int $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setWrite(Closure $write): self
    {
        $this->write = $write;
        return $this;
    }

    public function getWrite(): Closure|null
    {
        return $this->write ?? null;
    }

    public function getAttributes(): string
    {
        return $this->attributes;
    }

    public function setAttributes(string $attributes): void
    {
        $this->attributes = $attributes;
    }

    abstract public function getHtml(): string;
}
