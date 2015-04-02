<?php

namespace UserScape\HelpSpot\Test\Transformer;

use UserScape\HelpSpot\Test\Test;
use UserScape\HelpSpot\Transformer\ErrorsTransformer;

class ErrorsTransformerTest extends Test
{
    /**
     * Sample API error data.
     *
     * @var array
     */
    protected $sample = [
        "error" => [
            [
                "id"          => 1,
                "description" => "User authentication failed",
            ],
        ],
    ];

    /**
     * Checks to see if the transformer can correctly transform the sample API data into an object.
     *
     * @test
     */
    public function itTransformsSamplesCorrectly()
    {
        $transformer = new ErrorsTransformer();
        $transformed = $transformer->transform($this->sample);

        $this->assertInstanceOf("UserScape\\HelpSpot\\Object\\ErrorObject", $transformed[0]);

        $this->assertEquals($this->sample["error"][0]["id"], $transformed[0]->id());
        $this->assertEquals($this->sample["error"][0]["description"], $transformed[0]->description());
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

        $transformer = new ErrorsTransformer();
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
                    // "error" => true,
                ])
            ],
        ];
    }
}
