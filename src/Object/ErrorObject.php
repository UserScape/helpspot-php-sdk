<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object;

class ErrorObject implements Object
{
    use CloneWithMixin;
    use CreateMixin;
    use Mixin\DescriptionMixin;
    use Mixin\IdMixin;
}
