<?php

namespace UserScape\HelpSpot\Object\Mixin;

trait OrderMixin
{
    /**
     * @var int
     */
    protected $order;

    /**
     * @return int
     */
    public function order()
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return static
     */
    public function withOrder($order)
    {
        return $this->cloneWith("order", $order);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return static
     */
    abstract protected function cloneWith($key, $value);
}
