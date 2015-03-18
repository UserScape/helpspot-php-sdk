<?php

namespace UserScape\HelpSpot;

interface Transformer
{
    /**
     * Transforms an array of raw data into an object.
     *
     * @param array $data
     *
     * @return Object
     */
    public function transform(array $data);
}
