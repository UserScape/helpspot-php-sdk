<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Transformer;

class ErrorsTransformer implements Transformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $errors = [];

        $transformer = new ErrorTransformer();

        foreach ($data["error"] as $error) {
            $errors[] = $transformer->transform($error);
        }

        return $errors;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["error"]) or !is_array($data["error"])) {
            throw new InvalidArgumentException("Errors missing");
        }
    }
}
