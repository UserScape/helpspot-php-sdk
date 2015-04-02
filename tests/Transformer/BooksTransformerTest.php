<?php

namespace UserScape\HelpSpot\Test\Transformer;

use UserScape\HelpSpot\Test\Test;
use UserScape\HelpSpot\Transformer\BooksTransformer;

class BooksTransformerTest extends Test
{
    /**
     * Sample API book data.
     *
     * @var array
     */
    protected $sample = [
        "book" => [
            [
                "xBook"        => 1,
                "sBookName"    => "Helpfulness",
                "iOrder"       => 0,
                "tDescription" => "Helpful things!",
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
        $transformer = new BooksTransformer();
        $transformed = $transformer->transform($this->sample);

        $this->assertInstanceOf("UserScape\\HelpSpot\\Object\\BookObject", $transformed[0]);

        $this->assertEquals($this->sample["book"][0]["xBook"], $transformed[0]->id());
        $this->assertEquals($this->sample["book"][0]["sBookName"], $transformed[0]->name());
        $this->assertEquals($this->sample["book"][0]["iOrder"], $transformed[0]->order());
        $this->assertEquals($this->sample["book"][0]["tDescription"], $transformed[0]->description());
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

        $transformer = new BooksTransformer();
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
                    // "book" => true,
                ])
            ],
        ];
    }
}
