<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Object\BookObject;
use UserScape\HelpSpot\Transformer;

class BookTransformer implements Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        return new BookObject(
            (int) $data["xBook"],
            (string) $data["sBookName"],
            (int) $data["iOrder"],
            (string) $data["tDescription"]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["xBook"])) {
            throw new InvalidArgumentException("Book ID missing");
        }

        if (!isset($data["sBookName"])) {
            throw new InvalidArgumentException("Book name missing");
        }

        if (!isset($data["iOrder"])) {
            throw new InvalidArgumentException("Book order missing");
        }

        if (!isset($data["tDescription"])) {
            throw new InvalidArgumentException("Book description missing");
        }
    }
}
