<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Object;

class BookObject implements Object
{
    use CloneWithMixin;
    use Mixin\IdMixin;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $description;

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
     * @param int    $id
     * @param string $name
     * @param int    $order
     * @param string $description
     */
    public function __construct($id, $name, $order, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->order = $order;
        $this->description = $description;
    }
}
