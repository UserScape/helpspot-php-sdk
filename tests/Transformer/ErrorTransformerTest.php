<?php

namespace UserScape\HelpSpot\Test\Transformer;

use UserScape\HelpSpot\Test\Test;
use UserScape\HelpSpot\Transformer\ErrorTransformer;

class ErrorTransformerTest extends Test
{
    /**
     * Sample API error data.
     *
     * @var array
     */
    protected $sample = [
        "id"          => 1,
        "description" => "User authentication failed",
    ];

    /**
     * Checks to see if the transformer can correctly transform the sample API data into an object.
     *
     * @test
     */
    public function itTransformsSamplesCorrectly()
    {
        $transformer = new ErrorTransformer();
        $transformed = $transformer->transform($this->sample);

        $this->assertInstanceOf("UserScape\\HelpSpot\\Object\\ErrorObject", $transformed);

        $this->assertEquals($this->sample["id"], $transformed->id());
        $this->assertEquals($this->sample["description"], $transformed->description());
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

        $transformer = new ErrorTransformer();
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
                    // "id"          => true,
                    "description" => true,
                ])
            ],
            [
                array_intersect_key($this->sample, [
                    "id" => true,
                    // "description" => true,
                ])
            ],
        ];
    }
}
