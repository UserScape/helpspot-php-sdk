<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait LabelMixin
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return static
     */
    public function withLabel($label)
    {
        return $this->cloneWith("label", $label);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
