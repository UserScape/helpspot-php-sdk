<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object\ChapterObject;
use UserScape\HelpSpot\Transformer;

class ChapterTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        return ChapterObject::create()
            ->withId((int) $data["xChapter"])
            ->withName((string) $data["sChapterName"])
            ->withLabel((string) $data["name"])
            ->withOrder((int) $data["iOrder"])
            ->withAppendix((bool) $data["fAppendix"])
            ->withPages($this->pages($data));
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["xChapter"])) {
            throw new InvalidArgumentException("Chapter ID missing");
        }

        if (!isset($data["sChapterName"])) {
            throw new InvalidArgumentException("Chapter name missing");
        }

        if (!isset($data["name"])) {
            throw new InvalidArgumentException("Chapter label missing");
        }

        if (!isset($data["iOrder"])) {
            throw new InvalidArgumentException("Chapter order missing");
        }

        if (!isset($data["fAppendix"])) {
            throw new InvalidArgumentException("Chapter appendix missing");
        }

        if (!isset($data["pages"])) {
            throw new InvalidArgumentException("Chapter pages missing");
        }
    }

    /**
     * Transforms pages into PageObject instances.
     *
     * @param array $data
     *
     * @return array|Object
     */
    protected function pages(array $data)
    {
        return PagesTransformer::create()->transform($data["pages"]);
    }
}
