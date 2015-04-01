<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Object;

class ErrorObject implements Object
{
    use CloneWithMixin;
    use Mixin\DescriptionMixin;
    use Mixin\IdMixin;

    /**
     * @param int    $id
     * @param string $description
     */
    public function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }
}
