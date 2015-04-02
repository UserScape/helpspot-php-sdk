<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object;

class ChapterObject implements Object
{
    use CloneWithMixin;
    use CreateMixin;
    use Mixin\IdMixin;
    use Mixin\LabelMixin;
    use Mixin\NameMixin;
    use Mixin\OrderMixin;

    /**
     * @var bool
     */
    protected $appendix;

    /**
     * @var array
     */
    protected $pages;

    /**
     * @return bool
     */
    public function appendix()
    {
        return $this->appendix;
    }

    /**
     * @param bool $appendix
     *
     * @return static
     */
    public function withAppendix($appendix)
    {
        return $this->cloneWith("appendix", $appendix);
    }

    /**
     * @return array
     */
    public function pages()
    {
        return $this->pages;
    }

    /**
     * @param array $pages
     *
     * @return static
     */
    public function withPages(array $pages)
    {
        return $this->cloneWith("pages", $pages);
    }
}
