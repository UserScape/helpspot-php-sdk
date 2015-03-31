<?php

namespace UserScape\HelpSpot;

use InvalidArgumentException;

interface Transformer
{
    /**
     * Transforms an array of raw data into an object.
     *
     * @param array $data
     *
     * @return array|Object
     *
     * @throws InvalidArgumentException
     */
    public function transform(array $data);

    /**
     * Validates an array of raw data.
     *
     * @param array $data
     *
     * @throws InvalidArgumentException
     */
    public function validate(array $data);
}
