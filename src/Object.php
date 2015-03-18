<?php

namespace UserScape\HelpSpot;

interface Object
{
    /**
     * Returns the object ID.
     *
     * @return int
     */
    public function id();

    /**
     * Returns a new object, with most of the same attributes, and a new ID.
     *
     * @param int $id
     *
     * @return static
     */
    public function withId($id);
}
