<?php

namespace UserScape\HelpSpot\Transformer;

use InvalidArgumentException;
use UserScape\HelpSpot\Mixin\CreateMixin;
use UserScape\HelpSpot\Object\ErrorObject;
use UserScape\HelpSpot\Transformer;

class ErrorTransformer implements Transformer
{
    use CreateMixin;

    /**
     * {@inheritdoc}
     */
    public function transform(array $data)
    {
        $this->validate($data);

        return ErrorObject::create()
            ->withId((int) $data["id"])
            ->withDescription((string) $data["description"]);
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $data)
    {
        if (!isset($data["id"])) {
            throw new InvalidArgumentException("Error ID missing");
        }

        if (!isset($data["description"])) {
            throw new InvalidArgumentException("Error description missing");
        }
    }
}
