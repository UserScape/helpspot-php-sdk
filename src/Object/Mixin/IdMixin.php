<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait IdMixin
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return static
     */
    public function withId($id)
    {
        return $this->cloneWith("id", $id);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
