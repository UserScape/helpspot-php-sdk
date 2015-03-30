<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Transformer;

class BooksTransformer implements Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $books = [];

        $transformer = new BookTransformer();

        foreach ($data["book"] as $book) {
            $books[] = $transformer->transform($book);
        }

        return $books;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["book"]) or !is_array($data["book"])) {
            throw new InvalidArgumentException("Books missing");
        }
    }
}
