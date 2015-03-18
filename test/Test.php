<?php

namespace UserScape\HelpSpot\Test;

use Mockery;
use Mockery\Matcher\Type;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;

abstract class Test extends PHPUnit_Framework_TestCase
{
    /**
     * Resets Mockery for following tests.
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Returns a Mockery type matcher, for for fake method parameter specifications.
     *
     * @param string $type
     *
     * @return Type
     */
    public function newType($type)
    {
        return Mockery::type($type);
    }

    /**
     * Returns a Mockery mock.
     *
     * @param string $type
     *
     * @return MockInterface
     */
    public function newMock($type)
    {
        return Mockery::mock($type);
    }
}
