<?php

namespace UserScape\HelpSpot\Mixin;

trait CreateMixin
{
    /**
     * Returns a new instance of this class (for method chaining).
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }
}
