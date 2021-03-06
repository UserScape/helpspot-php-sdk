<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Transformer;

class ErrorsTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        $errors = [];

        foreach ((array) $data["error"] as $error) {
            $errors[] = ErrorTransformer::create()->transform($error);
        }

        return $errors;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["error"])) {
            throw new InvalidArgumentException("Errors missing");
        }
    }
}
