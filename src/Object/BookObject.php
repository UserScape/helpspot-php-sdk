<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Object;

class BookObject implements Object
{
    use CloneWithMixin;
    use Mixin\DescriptionMixin;
    use Mixin\IdMixin;
    use Mixin\NameMixin;
    use Mixin\OrderMixin;

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
