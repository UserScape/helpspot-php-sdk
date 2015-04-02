<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object;

class BookObject implements Object
{
    use CloneWithMixin;
    use CreateMixin;
    use Mixin\DescriptionMixin;
    use Mixin\IdMixin;
    use Mixin\NameMixin;
    use Mixin\OrderMixin;
}
