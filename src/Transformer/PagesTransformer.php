<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Transformer;

class PagesTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $books = [];

        foreach ((array) $data["page"] as $book) {
            $books[] = PageTransformer::create()->transform($book);
        }

        return $books;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["page"])) {
            throw new InvalidArgumentException("Pages missing");
        }
    }
}
