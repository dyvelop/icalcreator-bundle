<?php

namespace Dyvelop\ICalCreatorBundle\Tests\Component;

use Dyvelop\ICalCreatorBundle\Component\Calendar;
use Dyvelop\ICalCreatorBundle\Tests\CalendarTestCase;
use kigkonsult\iCalcreator\util\util;

/**
 * Tests for calendar component
 *
 * @package Dyvelop\ICalCreatorBundle\Tests
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class CalendarTest extends CalendarTestCase
{

    /**
     * Testing initiating calendar
     *
     * @param array $config Calendar config
     *
     * @dataProvider getCalendarConfigTestData
     */
    public function testInit(array $config)
    {
        $calendar = new Calendar($config);
        $this->assertCalendarConfigs($config, $calendar);
    }


    /**
     * Testing getter for content type
     *
     * @param array  $config      Calendar config
     * @param string $contentType Expected content type
     *
     * @dataProvider getCalendarContentTypeTestData
     */
    public function testGetContentType(array $config, $contentType)
    {
        $calendar = new Calendar($config);
        $this->assertEquals($contentType, $calendar->getContentType());
    }


    /**
     * Test creating new event for calendar
     */
    public function testNewEvent()
    {
        $calendar = new Calendar();
        $this->assertEmpty($calendar->getComponent('vevent'));

        $event = $calendar->newEvent();
        $this->assertInstanceOf('kigkonsult\iCalcreator\vevent', $event);

        $event->setProperty(util::$DESCRIPTION, 'Some event description');

        $expected = $calendar->getComponent('vevent');
        $this->assertEquals('Some event description', $expected->getProperty(util::$DESCRIPTION));
    }


    /**
     * Test setter for timezone
     */
    public function testSetTimezone()
    {
        $timezone = 'Europe/Berlin';
        $calendar = new Calendar();
        $reflection = new \ReflectionObject($calendar);
        $attribute = $reflection->getProperty('timezone');
        $attribute->setAccessible(true);

        // check timezone values before setting
        $this->assertEmpty($attribute->getValue($calendar));
        $this->assertEmpty($calendar->getConfig('TZID'));
        $this->assertFalse($calendar->getProperty('X-WR-TIMEZONE'));
        $this->assertFalse($calendar->getComponent('vtimezone'));

        // check timezone values after setting
        $calendar->setTimezone($timezone);
        $this->assertEquals($timezone, $attribute->getValue($calendar));
        $this->assertEquals($timezone, $calendar->getConfig('TZID'));
        $this->assertContains($timezone, $calendar->getProperty('X-WR-TIMEZONE'));

        // check timezone component
        $calendar->createCalendar();
        $this->assertInstanceOf('kigkonsult\iCalcreator\vtimezone', $calendar->getComponent('vtimezone'));
    }


    /**
     * Get calendar test config
     *
     * @return array
     */
    public function getCalendarContentTypeTestData()
    {
        return [
            [['format' => 'iCal'], 'text/calendar'],
            [['format' => 'xCal'], 'application/calendar+xml'],
        ];
    }
}
