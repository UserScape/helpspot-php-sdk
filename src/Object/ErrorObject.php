<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Object;

class ErrorObject implements Object
{
    use CloneWithMixin;
    use Mixin\IdMixin;

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
     * @param int    $id
     * @param string $description
     */
    public function __construct($id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }
}
