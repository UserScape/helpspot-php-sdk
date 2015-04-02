<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object\PageObject;
use UserScape\HelpSpot\Transformer;

class PageTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        return PageObject::create()
            ->withId((int) $data["xPage"])
            ->withName((string) $data["sPageName"])
            ->withLabel((string) $data["name"])
            ->withOrder((int) $data["iOrder"])
            ->withHighlight((bool) $data["fHighlight"])
            ->withTags($this->tags($data))
            ->withRelatedPages($this->relatedPages($data));
    }

    /**
     * Transforms tags.
     *
     * @param array $data
     *
     * @return array
     */
    protected function tags(array $data)
    {
        // TODO

        return (array) $data["tags"];
    }

    /**
     * Transforms related pages.
     *
     * @param array $data
     *
     * @return array
     */
    protected function relatedPages(array $data)
    {
        // TODO

        return (array) $data["relatedpages"];
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["xPage"])) {
            throw new InvalidArgumentException("Page ID missing");
        }

        if (!isset($data["sPageName"])) {
            throw new InvalidArgumentException("Page name missing");
        }

        if (!isset($data["name"])) {
            throw new InvalidArgumentException("Page label missing");
        }

        if (!isset($data["iOrder"])) {
            throw new InvalidArgumentException("Page order missing");
        }

        if (!isset($data["fHighlight"])) {
            throw new InvalidArgumentException("Page highlight missing");
        }
    }
}
