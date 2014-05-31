<?php

namespace FitnessTrackingPorting\Tests\Tracker\AbstractTracker;

use DateTimeZone;

class AbstractTrackerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for testGetTimeZoneOffsetProvider().
     *
     * @return array
     */
    public function testGetTimeZoneOffsetProvider()
    {
        return array(
            array(new DateTimeZone('UTC'), 0),
            array(new DateTimeZone('Europe/Berlin'), -7200),
            array(new DateTimeZone('Europe/Bucharest'), -10800),
            array(new DateTimeZone('Pacific/Auckland'), -43200),
            array(new DateTimeZone('America/Martinique'), 14400)
        );
    }

    /**
     * Test get time zone offset.
     *
     * @param DateTimeZone $originTimeZone The origin timezone.
     * @param integer $expected The number of seconds expected to be the time zone difference.
     * @dataProvider testGetTimeZoneOffsetProvider
     */
    public function testGetTimeZoneOffset($originTimeZone, $expected)
    {
        $mock = $this->getMockBuilder('FitnessTrackingPorting\Tracker\AbstractTracker')
            ->setMethods(array('getTimeZone'))
            ->getMockForAbstractClass();
        $mock->expects($this->any())
            ->method('getTimeZone')
            ->will($this->returnValue($originTimeZone));

        $this->assertEquals($expected, $mock->getTimeZoneOffset());
    }
}
 