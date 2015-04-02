<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Transformer;

class ChaptersTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $books = [];

        foreach ((array) $data["chapter"] as $book) {
            $books[] = ChapterTransformer::create()->transform($book);
        }

        return $books;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["chapter"])) {
            throw new InvalidArgumentException("Chapters missing");
        }
    }
}
