<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait NameMixin
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function withName($name)
    {
        return $this->cloneWith("name", $name);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
