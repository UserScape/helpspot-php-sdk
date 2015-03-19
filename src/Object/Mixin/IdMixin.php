<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait IdMixin
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Returns the object ID.
     *
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Returns a new object, with most of the same attributes, and a new ID.
     *
     * @param int $id
     *
     * @return static
     */
    public function withId($id)
    {
        return $this->cloneWith("id", $id);
    }

    /**
     * Returns a clone of the object, with a new attribute value.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
