<?php

namespace UserScape\HelpSpot\Test\Object;

use UserScape\HelpSpot\Object\ErrorObject;
use UserScape\HelpSpot\Test\Test;

class ErrorObjectTest extends Test
{
    /**
     * Sample API error data.
     *
     * @var array
     */
    protected $sample = [
        "id"        => 1,
        "description" => "User authentication failed",
    ];

    /**
     * Object methods to run, with new values, to test attribute modifiers.
     *
     * @var array
     */
    protected $modifiers = [
        "withId"          => 2,
        "withDescription" => "Authentication information not sent",
    ];

    /**
     * Object methods to run to fetch values altered by the modifier methods.
     *
     * @var array
     */
    protected $getters = [
        "withId"          => "id",
        "withDescription" => "description",
    ];

    /**
     * Check to see if the object correctly clones itself with new attribute values.
     *
     * @test
     */
    public function itClonesWithNewAttributes()
    {
        $object = new ErrorObject(
            (int) $this->sample["id"],
            (string) $this->sample["description"]
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
