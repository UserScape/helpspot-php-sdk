<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Transformer;

class BooksTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $books = [];

        foreach ((array) $data["book"] as $book) {
            $books[] = BookTransformer::create()->transform($book);
        }

        return $books;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["book"])) {
            throw new InvalidArgumentException("Books missing");
        }
    }
}
