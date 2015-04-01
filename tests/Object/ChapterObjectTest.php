<?php

namespace UserScape\HelpSpot\Test\Object;

use UserScape\HelpSpot\Object\ChapterObject;
use UserScape\HelpSpot\Test\Test;

class ChapterObjectTest extends Test
{
    /**
     * Sample API chapter data.
     *
     * @var array
     */
    protected $sample = [
        "xChapter"     => 2,
        "sChapterName" => "Getting Started",
        "name"         => "1. Getting Started",
        "iOrder"       => 1,
        "fAppendix"    => false,
        "pages"        => [],
    ];

    /**
     * Object methods to run, with new values, to test attribute modifiers.
     *
     * @var array
     */
    protected $modifiers = [
        "withId"       => 3,
        "withName"     => "Getting Finished",
        "withLabel"    => "1. Getting Finished",
        "withOrder"    => 2,
        "withAppendix" => true,
        "withPages"    => ["foo"],
    ];

    /**
     * Object methods to run to fetch values altered by the modifier methods.
     *
     * @var array
     */
    protected $getters = [
        "withId"       => "id",
        "withName"     => "name",
        "withLabel"    => "label",
        "withOrder"    => "order",
        "withAppendix" => "appendix",
        "withPages"    => "pages",
    ];

    /**
     * Check to see if the object correctly clones itself with new attribute values.
     *
     * @test
     */
    public function itClonesWithNewAttributes()
    {
        $object = new ChapterObject(
            $this->sample["xChapter"],
            $this->sample["sChapterName"],
            $this->sample["name"],
            $this->sample["iOrder"],
            $this->sample["fAppendix"],
            $this->sample["pages"]
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
