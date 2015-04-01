<?php

namespace UserScape\HelpSpot\Test\Object;

use UserScape\HelpSpot\Object\PageObject;
use UserScape\HelpSpot\Test\Test;

class PageObjectTest extends Test
{
    /**
     * Sample API page data.
     *
     * @var array
     */
    protected $sample = [
        "xPage"        => 2,
        "sPageName"    => "Getting your help desk up and running",
        "name"         => "1.1. Getting your help desk up and running",
        "iOrder"       => 1,
        "fHighlight"   => true,
        "tags"         => [],
        "relatedpages" => [],
    ];

    /**
     * Object methods to run, with new values, to test attribute modifiers.
     *
     * @var array
     */
    protected $modifiers = [
        "withId"           => 3,
        "withName"         => "Getting your help desk down and running",
        "withLabel"        => "1.1. Getting your help desk down and running",
        "withOrder"        => 2,
        "withHighlight"    => false,
        "withTags"         => ["foo"],
        "withRelatedPages" => ["foo"],
    ];

    /**
     * Object methods to run to fetch values altered by the modifier methods.
     *
     * @var array
     */
    protected $getters = [
        "withId"           => "id",
        "withName"         => "name",
        "withLabel"        => "label",
        "withOrder"        => "order",
        "withHighlight"    => "highlight",
        "withTags"         => "tags",
        "withRelatedPages" => "relatedPages",
        "withChapter"      => "chapter",
    ];

    /**
     * Create new ChapterObject mocks to test getters/modifiers.
     */
    public function setUp()
    {
        parent::setUp();

        $this->sample["chapter"] = $this->newMock("UserScape\\HelpSpot\\ChapterObject");

        $this->modifiers["chapter"] = $this->newMock("UserScape\\HelpSpot\\ChapterObject");
    }

    /**
     * Check to see if the object correctly clones itself with new attribute values.
     *
     * @test
     */
    public function itClonesWithNewAttributes()
    {
        $object = new PageObject(
            $this->sample["xPage"],
            $this->sample["sPageName"],
            $this->sample["name"],
            $this->sample["iOrder"],
            $this->sample["fHighlight"],
            $this->sample["tags"],
            $this->sample["relatedpages"],
            $this->sample["chapter"]
        );

        foreach ($this->modifiers as $modifier => $value) {
            $clone = $object->$modifier($value);

            $getter = $this->getters[$modifier];

            $this->assertInstanceOf(get_class($object), $clone);
            $this->assertNotSame($object, $clone);

            $this->assertEquals($value, $clone->$getter());
            $this->assertNotEquals($object->$getter(), $clone->$getter(), $getter);
        }
    }
}
