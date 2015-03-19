<?php

namespace UserScape\HelpSpot\Test\Transformer;

use UserScape\HelpSpot\Test\Test;
use UserScape\HelpSpot\Transformer\BookTransformer;

class BookTransformerTest extends Test
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
     * Checks to see if the transformer can correctly transform the sample API data into an object.
     *
     * @test
     */
    public function itTransformsSamplesCorrectly()
    {
        $transformer = new BookTransformer();
        $transformed = $transformer->transform($this->sample);

        $this->assertInstanceOf("UserScape\\HelpSpot\\Object\\BookObject", $transformed);

        $this->assertEquals($this->sample["xBook"], $transformed->id());
        $this->assertEquals($this->sample["sBookName"], $transformed->name());
        $this->assertEquals($this->sample["iOrder"], $transformed->order());
        $this->assertEquals($this->sample["tDescription"], $transformed->description());
    }

    /**
     * Checks to see if the transformer will throw for malformed API data.
     *
     * @param array $data A malformed API data array (missing a single required key).
     *
     * @dataProvider malformedDataProvider
     *
     * @test
     */
    public function itThrowsForMalformedData(array $data)
    {
        $this->setExpectedException("InvalidArgumentException");

        $transformer = new BookTransformer();
        $transformer->validate($data);
    }

    /**
     * Generates arrays of malformed API data, to test the validator.
     *
     * @see https://phpunit.de/manual/current/en/phpunit-book.html#writing-tests-for-phpunit.data-providers
     *
     * @return array
     */
    public function malformedDataProvider()
    {
        return [
            [
                array_intersect_key($this->sample, [
                    // "xBook"        => true,
                    "sBookName"    => true,
                    "iOrder"       => true,
                    "tDescription" => true,
                ])
            ],
            [
                array_intersect_key($this->sample, [
                    "xBook"        => true,
                    // "sBookName"    => true,
                    "iOrder"       => true,
                    "tDescription" => true,
                ])
            ],
            [
                array_intersect_key($this->sample, [
                    "xBook"        => true,
                    "sBookName"    => true,
                    // "iOrder"       => true,
                    "tDescription" => true,
                ])
            ],
            [
                array_intersect_key($this->sample, [
                    "xBook"     => true,
                    "sBookName" => true,
                    "iOrder"    => true,
                    // "tDescription" => true,
                ])
            ],
        ];
    }
}
