<?php

namespace UserScape\HelpSpot\Object;

use UserScape\HelpSpot\Mixin\CloneWithMixin;
use UserScape\HelpSpot\Object;

class PageObject implements Object
{
    use CloneWithMixin;
    use Mixin\IdMixin;
    use Mixin\LabelMixin;
    use Mixin\NameMixin;
    use Mixin\OrderMixin;

    /**
     * @var ChapterObject
     */
    protected $chapter;

    /**
     * @var bool
     */
    protected $highlight;

    /**
     * @var array
     */
    protected $tags;

    /**
     * @var array
     */
    protected $relatedPages;

    /**
     * @return ChapterObject
     */
    public function chapter()
    {
        return $this->chapter;
    }

    /**
     * @param ChapterObject $chapter
     *
     * @return static
     */
    public function withChapter(ChapterObject $chapter)
    {
        return $this->cloneWith("chapter", $chapter);
    }

    /**
     * @return bool
     */
    public function highlight()
    {
        return $this->highlight;
    }

    /**
     * @param bool $highlight
     *
     * @return static
     */
    public function withHighlight($highlight)
    {
        return $this->cloneWith("highlight", $highlight);
    }

    /**
     * @return array
     */
    public function tags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @return static
     */
    public function withTags(array $tags)
    {
        return $this->cloneWith("tags", $tags);
    }

    /**
     * @return array
     */
    public function relatedPages()
    {
        return $this->relatedPages;
    }

    /**
     * @param array $relatedPages
     *
     * @return static
     */
    public function withRelatedPages(array $relatedPages)
    {
        return $this->cloneWith("relatedPages", $relatedPages);
    }

    /**
     * @param int           $id
     * @param string        $name
     * @param string        $label
     * @param int           $order
     * @param bool          $highlight
     * @param array         $tags
     * @param array         $relatedPages
     * @param ChapterObject $chapter
     */
    public function __construct($id, $name, $label, $order, $highlight, array $tags, array $relatedPages, ChapterObject $chapter)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->order = $order;
        $this->highlight = $highlight;
        $this->tags = $tags;
        $this->relatedPages = $relatedPages;
        $this->chapter = $chapter;
    }
}
