<?php

namespace UserScape\HelpSpot\Mixin;

trait CloneWithMixin
{
    /**
     * Returns a clone of the object, with a new attribute value.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    protected function cloneWith($key, $value)
    {
        $clone = clone $this;

        $clone->$key = $value;

        return $clone;
    }
}
