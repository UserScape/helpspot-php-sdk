<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait DescriptionMixin
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function withDescription($description)
    {
        return $this->cloneWith("description", $description);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
