<?php

namespace Dyvelop\ICalCreatorBundle\Tests;

use Dyvelop\ICalCreatorBundle\Component\Calendar;

/**
 * Abstract calendar test case
 *
 * @package Dyvelop\ICalCreatorBundle\Tests
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
abstract class CalendarTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Get config test data
     *
     * @return array
     */
    public function getCalendarTestData()
    {
        return array(
            array(new Calendar(array('format' => 'ical')), array('foo' => 'bar')),
            array(new Calendar(array('format' => 'xcal'))),
        );
    }
}
