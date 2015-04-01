<?php

namespace UserScape\HelpSpot\Test\Object;

use UserScape\HelpSpot\Object\BookObject;
use UserScape\HelpSpot\Test\Test;

class BookObjectTest extends Test
{
    /**
     * Sample API book data.
     *
     * @var array
     */
    protected $sample = [
        "xBook"        => 1,
        "sBookName"    => "Helpfulness",
        "iOrder"       => 0,
        "tDescription" => "Helpful things!",
    ];

    /**
     * Object methods to run, with new values, to test attribute modifiers.
     *
     * @var array
     */
    protected $modifiers = [
        "withId"          => 2,
        "withName"        => "Unhelpfulness",
        "withOrder"       => 1,
        "withDescription" => "Useless things!",
    ];

    /**
     * Object methods to run to fetch values altered by the modifier methods.
     *
     * @var array
     */
    protected $getters = [
        "withId"          => "id",
        "withName"        => "name",
        "withOrder"       => "order",
        "withDescription" => "description",
    ];

    /**
     * Check to see if the object correctly clones itself with new attribute values.
     *
     * @test
     */
    public function itClonesWithNewAttributes()
    {
        $object = new BookObject(
            $this->sample["xBook"],
            $this->sample["sBookName"],
            $this->sample["iOrder"],
            $this->sample["tDescription"]
        );

        foreach ($this->modifiers as $modifier => $value) {
            $clone = $object->$modifier($value);

            $getter = $this->getters[$modifier];

            $this->assertInstanceOf(get_class($object), $clone);
            $this->assertNotSame($object, $clone);

            $this->assertEquals($value, $clone->$getter());
            $this->assertNotEquals($object->$getter(), $clone->$getter());
        }
    }
}
